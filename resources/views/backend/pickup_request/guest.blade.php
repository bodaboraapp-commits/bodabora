@extends('backend.partials.master')
@section('title')
Guest Pickup
@endsection
@section('maincontent')
<!-- wrapper  -->
<div class="container-fluid  dashboard-content">
    <!-- pageheader -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}" class="breadcrumb-link">{{ __('levels.dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">{{ __('pickupRequest.pickup_request') }}</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link active">Guest Pickup</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- end pageheader -->
    <div class="row">
        <!-- table  -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="row pl-4 pr-4 pt-4">
                    <div class="col-12">
                        <p class="h3 mb-0">Guest Pickup</p>
                        <p class="text-muted small mb-0">Bookings submitted from the website's "Book a Pickup" form — guests without a merchant account.</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table   " style="width:100%">
                            <thead>
                                <tr>
                                    <th>{{ __('levels.id') }}</th>
                                    <th>Sender</th>
                                    <th>Pickup</th>
                                    <th>Deliver to</th>
                                    <th>Receiver</th>
                                    <th>Parcels</th>
                                    <th>Preferred</th>
                                    <th>Requested</th>
                                    <th>Status</th>
                                    <th class="text-right">{{ __('levels.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>
                                            <strong>{{ $booking->name }}</strong>
                                            <div><small class="text-muted">{{ $booking->phone }}</small></div>
                                            @if($booking->email)<div><small class="text-muted">{{ $booking->email }}</small></div>@endif
                                        </td>
                                        <td>{{ \Illuminate\Support\Str::limit($booking->pickup_address, 45) }}</td>
                                        <td>{{ $booking->dropoff_address ? \Illuminate\Support\Str::limit($booking->dropoff_address, 45) : '—' }}</td>
                                        <td>
                                            <div>{{ $booking->receiver_name ?: '—' }}</div>
                                            @if($booking->receiver_phone)<small class="text-muted">{{ $booking->receiver_phone }}</small>@endif
                                        </td>
                                        <td>
                                            <span class="badge badge-light border">{{ $booking->parcel_quantity }}</span>
                                            @if($booking->weight)<div><small class="text-muted">{{ $booking->weight }}</small></div>@endif
                                        </td>
                                        <td>
                                            <div>{{ $booking->preferred_date ? $booking->preferred_date->format('d M Y') : '—' }}</div>
                                            @if($booking->preferred_time)<small class="text-muted">{{ $booking->preferred_time }}</small>@endif
                                        </td>
                                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if($moved->has($booking->id))
                                                <span class="badge badge-success">Moved &rarr; {{ $moved[$booking->id]->request_type == \App\Enums\PickupRequestType::EXPRESS ? 'Express' : 'Regular' }}</span>
                                            @else
                                                <span class="badge badge-secondary">New</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('pickup.request.guest.edit', $booking->id) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                            @if(! $moved->has($booking->id))
                                                <form action="{{ route('pickup.request.guest.move', $booking->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Move this guest pickup to the selected workflow?');">
                                                    @csrf
                                                    <div class="input-group input-group-sm d-inline-flex" style="width:170px;vertical-align:middle;">
                                                        <select name="type" class="form-control form-control-sm">
                                                            <option value="regular">Regular</option>
                                                            <option value="express">Express</option>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Move">Move</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                            @if (hasPermission('agent_delete') == true)
                                                <form action="{{ route('admin.agent.booking.delete', $booking->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this booking?');">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="10" class="text-center py-4 text-muted">No guest pickups yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="px-3 d-flex flex-row-reverse align-items-center">
                    <span>{{ $bookings->links() }}</span>
                    <p class="p-2 small">
                        {!! __('Showing') !!}
                        <span class="font-medium">{{ $bookings->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $bookings->lastItem() }}</span>
                        {!! __('of') !!}
                        <span class="font-medium">{{ $bookings->total() }}</span>
                        {!! __('results') !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end wrapper  -->
@endsection()
