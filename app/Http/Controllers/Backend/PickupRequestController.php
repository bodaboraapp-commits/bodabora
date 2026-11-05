<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PickupRequestType;
use App\Http\Controllers\Controller;
use App\Models\Backend\PickupBooking;
use App\Models\PickupRequest;
use App\Repositories\MerchantPanel\PickupRequest\PickupRequestInterface;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PickupRequestController extends Controller
{
    protected $repo;
    public function __construct(PickupRequestInterface $repo){
        $this->repo = $repo;
    }
    public function regular(){
        $regulars = $this->repo->getRegular();
        return view('backend.pickup_request.regular',compact('regulars'));
    }
    public function express(){
        $expresses  = $this->repo->getExpress();
        return view('backend.pickup_request.express',compact('expresses'));
    }
    public function guest(Request $request){
        // Public "Book a Pickup" submissions: guests without a merchant account.
        $bookings = PickupBooking::query()
            ->orderByDesc('id')
            ->paginate(15)
            ->appends($request->all());

        // Bookings already confirmed and moved into the Regular/Express workflow.
        $moved = PickupRequest::whereIn('guest_booking_id', $bookings->pluck('id'))
            ->orderBy('id')
            ->get()
            ->keyBy('guest_booking_id');

        return view('backend.pickup_request.guest',compact('bookings','moved'));
    }

    public function guestEdit($id){
        $booking   = PickupBooking::findOrFail($id);
        $converted = PickupRequest::where('guest_booking_id', $booking->id)->latest('id')->first();

        return view('backend.pickup_request.guest_edit',compact('booking','converted'));
    }

    public function guestUpdate(Request $request, $id){
        $booking = PickupBooking::findOrFail($id);
        $validated = $request->validate($this->guestRules());

        $booking->update($this->guestBookingData($validated));

        Toastr::success('Guest pickup updated.','Success');
        return redirect()->route('pickup.request.guest');
    }

    public function guestMove(Request $request, $id){
        $booking = PickupBooking::findOrFail($id);

        $validated = $request->validate(array_merge($this->guestRules(),[
            'type'            => ['required','in:regular,express'],
            'move_weight'     => ['nullable','numeric'],
            'move_cod_amount' => ['nullable','numeric'],
            'move_invoice'    => ['nullable','string','max:255'],
            'move_exchange'   => ['nullable','boolean'],
        ]));

        if ($already = PickupRequest::where('guest_booking_id', $booking->id)->first()) {
            Toastr::warning('This guest pickup was already moved to '.ucfirst($already->request_type == PickupRequestType::EXPRESS ? 'express' : 'regular').'.','Notice');
            return redirect()->route('pickup.request.guest');
        }

        // Persist any edits made on the way in, then create the workflow request.
        $booking->update($this->guestBookingData($validated));

        $pickup                   = new PickupRequest();
        $pickup->request_type     = $validated['type'] === 'express' ? PickupRequestType::EXPRESS : PickupRequestType::REGULAR;
        $pickup->merchant_id      = null;
        $pickup->guest_booking_id = $booking->id;
        $pickup->address          = $booking->pickup_address;
        $pickup->name             = $booking->name;
        $pickup->phone            = $booking->phone;
        $pickup->parcel_quantity  = $booking->parcel_quantity ?: 1;
        $pickup->note             = $this->guestRequestNote($booking);

        if ($validated['type'] === 'express') {
            $pickup->weight      = $validated['move_weight'] ?? (is_numeric($booking->weight) ? (int) $booking->weight : 0);
            $pickup->cod_amount  = $validated['move_cod_amount'] ?? 0;
            $pickup->invoice     = $validated['move_invoice'] ?? null;
            $pickup->exchange    = ! empty($validated['move_exchange']) ? 1 : 0;
        }

        $pickup->save();

        Toastr::success('Guest pickup moved to '.ucfirst($validated['type']).'.','Success');
        return redirect()->route('pickup.request.guest');
    }

    /**
     * Validation for the guest pickup fields (all optional so the same rules can
     * be reused by the quick "move" action on the list screen).
     */
    private function guestRules(): array
    {
        return [
            'name'            => ['sometimes','required','string','max:255'],
            'phone'           => ['sometimes','required','string','max:30','regex:/^[0-9+()\s-]{9,20}$/'],
            'email'           => ['nullable','email','max:255'],
            'pickup_address'  => ['sometimes','required','string','max:500'],
            'dropoff_address' => ['nullable','string','max:500'],
            'receiver_name'   => ['nullable','string','max:255'],
            'receiver_phone'  => ['nullable','string','max:30','regex:/^[0-9+()\s-]{9,20}$/'],
            'parcel_quantity' => ['sometimes','required','integer','min:1','max:500'],
            'weight'          => ['nullable','string','max:50'],
            'preferred_date'  => ['nullable','date'],
            'preferred_time'  => ['nullable','string','max:50'],
            'notes'           => ['nullable','string','max:1000'],
        ];
    }

    private function guestBookingData(array $validated): array
    {
        $data = array_intersect_key($validated, $this->guestRules());

        if (isset($data['phone'])) {
            $data['phone'] = $this->normalisePhone($data['phone']);
        }
        if (! empty($data['receiver_phone'])) {
            $data['receiver_phone'] = $this->normalisePhone($data['receiver_phone']);
        }

        return $data;
    }

    private function guestRequestNote(PickupBooking $booking): string
    {
        $parts = array_filter([
            $booking->notes,
            $booking->receiver_name || $booking->receiver_phone
                ? 'Receiver: '.trim($booking->receiver_name.' ('.$booking->receiver_phone.')', ' ()')
                : null,
            $booking->dropoff_address ? 'Deliver to: '.$booking->dropoff_address : null,
            $booking->preferred_date
                ? 'Preferred: '.$booking->preferred_date->format('d M Y').($booking->preferred_time ? ' '.$booking->preferred_time : '')
                : null,
        ]);

        return implode("\n", $parts);
    }

    private function normalisePhone(string $phone): string
    {
        return preg_replace('/[^0-9+]/', '', $phone);
    }
}
