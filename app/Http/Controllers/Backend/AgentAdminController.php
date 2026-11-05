<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Agent;
use App\Models\Backend\PickupBooking;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AgentAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->filled('search') ? $request->search : null;

        $agents = Agent::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($w) use ($search) {
                    $w->where('name', 'like', "%{$search}%")
                        ->orWhere('business_name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(15, ['*'], 'agents_page')
            ->appends($request->all());

        $bookings = PickupBooking::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($w) use ($search) {
                    $w->where('name', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('pickup_address', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(15, ['*'], 'bookings_page')
            ->appends($request->all());

        $metrics = [
            'agents'    => Agent::count(),
            'sellers'   => Agent::where('type', 'seller')->count(),
            'shops'     => Agent::where('type', 'shop')->count(),
            'bookings'  => PickupBooking::count(),
        ];

        return view('backend.agents.index', compact('agents', 'bookings', 'metrics', 'search'));
    }

    public function destroyAgent($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();

        Toastr::success('Agent application deleted.', 'Success');
        return redirect()->back();
    }

    public function destroyBooking($id)
    {
        $booking = PickupBooking::findOrFail($id);
        $booking->delete();

        Toastr::success('Pickup booking deleted.', 'Success');
        return redirect()->back();
    }
}
