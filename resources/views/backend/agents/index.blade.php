@extends('backend.partials.master')
@section('title')
    Agents, Sellers &amp; Pickup Bookings
@endsection
@section('maincontent')
<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="breadcrumb-link">{{ __('levels.dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link active">Agents &amp; Pickup Bookings</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Metrics -->
    <div class="row mb-4">
        @foreach ([
            ['Agents & sellers', $metrics['agents'], 'fas fa-handshake'],
            ['Online sellers', $metrics['sellers'], 'fas fa-store'],
            ['Existing shops', $metrics['shops'], 'fas fa-shop'],
            ['Pickup bookings', $metrics['bookings'], 'fas fa-box'],
        ] as $card)
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card border-3 border-top border-top-primary total-card-color h-100">
                    <div class="card-body total-card-body">
                        <div class="text-center d-flex">
                            <label class="icon p-10px"><i class="{{ $card[2] }}"></i></label>
                            <div class="box-content w-100 text-left">
                                <h5 class="text-muted">{{ $card[0] }}</h5>
                                <div class="metric-value d-inline-block">
                                    <h1 class="mb-1">{{ number_format($card[1]) }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Search -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <form action="{{ route('admin.agents.index') }}" method="GET" class="row g-3 align-items-center">
                    <div class="col-md-9">
                        <input type="text" name="search" class="form-control" placeholder="Search name, business, phone, email or pickup address…" value="{{ $search }}">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-grow-1"><i class="fa fa-search mr-1"></i> Search</button>
                        <a href="{{ route('admin.agents.index') }}" class="btn btn-secondary">Clear</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Agent / seller / shop applications -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body">
                    <h4 class="mb-3">Agent, seller &amp; shop applications</h4>
                    <div class="table-responsive">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name / business</th>
                                    <th>Wants to</th>
                                    <th>Phone / email</th>
                                    <th>Location</th>
                                    <th>Parcels / week</th>
                                    <th>Applied</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agents as $agent)
                                    <tr>
                                        <td>{{ $agent->id }}</td>
                                        <td>
                                            <strong class="text-dark">{{ $agent->name }}</strong>
                                            @if($agent->business_name)<div><small class="text-muted">{{ $agent->business_name }}</small></div>@endif
                                        </td>
                                        <td><span class="badge bg-light text-dark border px-2 py-1">{{ $agent->type_label }}</span></td>
                                        <td>
                                            <div>{{ $agent->phone }}</div>
                                            @if($agent->email)<small class="text-muted">{{ $agent->email }}</small>@endif
                                        </td>
                                        <td>
                                            <div>{{ $agent->county ?: '—' }}</div>
                                            @if($agent->address)<small class="text-muted">{{ \Illuminate\Support\Str::limit($agent->address, 40) }}</small>@endif
                                        </td>
                                        <td>{{ $agent->volume ?: '—' }}</td>
                                        <td>{{ $agent->created_at->format('d M Y') }}</td>
                                        <td class="text-right">
                                            <form action="{{ route('admin.agent.delete', $agent->id) }}" method="POST" onsubmit="return confirm('Delete this application?');">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" class="text-center py-4 text-muted">No applications yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-row-reverse">{{ $agents->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pickup bookings -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-body">
                    <h4 class="mb-3">Public pickup bookings</h4>
                    <div class="table-responsive">
                        <table class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Pickup</th>
                                    <th>Deliver to</th>
                                    <th>Parcels</th>
                                    <th>Preferred</th>
                                    <th>Requested</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>
                                            <strong class="text-dark">{{ $booking->name }}</strong>
                                            <div><small class="text-muted">{{ $booking->phone }}</small></div>
                                        </td>
                                        <td>{{ \Illuminate\Support\Str::limit($booking->pickup_address, 45) }}</td>
                                        <td>
                                            <div>{{ $booking->dropoff_address ? \Illuminate\Support\Str::limit($booking->dropoff_address, 45) : '—' }}</div>
                                            @if($booking->receiver_name || $booking->receiver_phone)
                                                <small class="text-muted">{{ trim($booking->receiver_name . ' ' . $booking->receiver_phone) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1">{{ $booking->parcel_quantity }}</span>
                                            @if($booking->weight)<div><small class="text-muted">{{ $booking->weight }}</small></div>@endif
                                        </td>
                                        <td>
                                            <div>{{ $booking->preferred_date ? $booking->preferred_date->format('d M Y') : '—' }}</div>
                                            @if($booking->preferred_time)<small class="text-muted">{{ $booking->preferred_time }}</small>@endif
                                        </td>
                                        <td>{{ $booking->created_at->format('d M Y') }}</td>
                                        <td class="text-right">
                                            <form action="{{ route('admin.agent.booking.delete', $booking->id) }}" method="POST" onsubmit="return confirm('Delete this booking?');">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" class="text-center py-4 text-muted">No pickup bookings yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-row-reverse">{{ $bookings->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
