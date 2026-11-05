<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Agent;
use App\Models\Backend\PickupBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AgentController extends Controller
{
    /**
     * Public "earn with BodaBora" page: agent / seller / shop applications
     * plus public parcel pickup bookings.
     */
    public function index(Request $request)
    {
        $query = Agent::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('business_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('county', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $agents = $query->orderByDesc('id')->get();

        if (! View::exists(active_theme() . '.pages.agents')) {
            return view('frontend.theme-3.pages.agents', compact('agents'));
        }

        return theme_view('pages.agents', compact('agents'));
    }

    public function storeAgent(Request $request)
    {
        $validated = $request->validateWithBag('agent', [
            'name'          => ['required', 'string', 'max:255'],
            'business_name' => ['nullable', 'string', 'max:255'],
            'email'         => ['nullable', 'email', 'max:255'],
            'phone'         => ['required', 'string', 'max:30', 'regex:/^[0-9+()\s-]{9,20}$/'],
            'type'          => ['required', 'in:agent,seller,shop'],
            'county'        => ['nullable', 'string', 'max:100'],
            'address'       => ['nullable', 'string', 'max:500'],
            'volume'        => ['nullable', 'string', 'max:100'],
            'notes'         => ['nullable', 'string', 'max:1000'],
        ], [
            'phone.regex'   => 'Please enter a valid phone number.',
            'type.required' => 'Please tell us how you want to work with us.',
        ]);

        $validated['phone']  = $this->normalisePhone($validated['phone']);
        $validated['status'] = 1;

        Agent::create($validated);

        // Flash rather than Toastr: the theme layout does not render toast messages.
        return redirect()->to(route('agents.index') . '#join')
            ->with('agent_success', 'Application received. Our partnerships team will contact you within 2 working days.');
    }

    public function storePickup(Request $request)
    {
        $validated = $request->validateWithBag('pickup', [
            'name'               => ['required', 'string', 'max:255'],
            'phone'              => ['required', 'string', 'max:30', 'regex:/^[0-9+()\s-]{9,20}$/'],
            'email'              => ['nullable', 'email', 'max:255'],
            'pickup_address'     => ['required', 'string', 'max:500'],
            'dropoff_address'    => ['nullable', 'string', 'max:500'],
            'receiver_name'      => ['required', 'string', 'max:255'],
            'receiver_phone'     => ['required', 'string', 'max:30', 'regex:/^[0-9+()\s-]{9,20}$/'],
            'parcel_description' => ['nullable', 'string', 'max:500'],
            'parcel_quantity'    => ['required', 'integer', 'min:1', 'max:500'],
            'weight'             => ['nullable', 'string', 'max:50'],
            'preferred_date'     => ['nullable', 'date', 'after_or_equal:today'],
            'preferred_time'     => ['nullable', 'string', 'max:50'],
            'notes'              => ['nullable', 'string', 'max:1000'],
        ], [
            'phone.regex'                   => 'Please enter a valid phone number.',
            'receiver_phone.regex'          => 'Please enter a valid receiver phone number.',
            'parcel_quantity.required'      => 'Please tell us how many parcels we are collecting.',
            'preferred_date.after_or_equal' => 'Please choose today or a future date for the pickup.',
        ]);

        $validated['phone']  = $this->normalisePhone($validated['phone']);
        if (! empty($validated['receiver_phone'])) {
            $validated['receiver_phone'] = $this->normalisePhone($validated['receiver_phone']);
        }
        $validated['status'] = 1;

        PickupBooking::create($validated);

        return redirect()->to(route('agents.index') . '#pickup')
            ->with('pickup_success', 'Pickup request received. We will confirm your rider by phone shortly.');
    }

    private function normalisePhone(string $phone): string
    {
        return preg_replace('/[^0-9+]/', '', $phone);
    }
}
