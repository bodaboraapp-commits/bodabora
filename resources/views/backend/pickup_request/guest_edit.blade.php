@extends('backend.partials.master')
@section('title')
Edit Guest Pickup
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
                            <li class="breadcrumb-item"><a href="{{ route('pickup.request.guest') }}" class="breadcrumb-link">Guest Pickup</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link active">Edit #{{ $booking->id }}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- end pageheader -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($converted)
        <div class="alert alert-info">
            This guest pickup was already moved to
            <strong>{{ $converted->request_type == \App\Enums\PickupRequestType::EXPRESS ? 'Express' : 'Regular' }}</strong>
            (request #{{ $converted->id }}).
        </div>
    @endif

    <form action="{{ route('pickup.request.guest.update', $booking->id) }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="row pl-4 pr-4 pt-4">
                        <div class="col-12">
                            <p class="h3 mb-0">Guest pickup #{{ $booking->id }}</p>
                            <p class="text-muted small mb-0">Requested {{ $booking->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Sender name</label>
                                <input type="text" name="name" value="{{ old('name', $booking->name) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Sender phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $booking->phone) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Sender email</label>
                                <input type="email" name="email" value="{{ old('email', $booking->email) }}" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Number of parcels</label>
                                <input type="number" name="parcel_quantity" min="1" max="500" value="{{ old('parcel_quantity', $booking->parcel_quantity ?: 1) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Pickup address</label>
                                <input type="text" name="pickup_address" value="{{ old('pickup_address', $booking->pickup_address) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Delivery address</label>
                                <input type="text" name="dropoff_address" value="{{ old('dropoff_address', $booking->dropoff_address) }}" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Receiver name</label>
                                <input type="text" name="receiver_name" value="{{ old('receiver_name', $booking->receiver_name) }}" class="form-control">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Receiver phone</label>
                                <input type="text" name="receiver_phone" value="{{ old('receiver_phone', $booking->receiver_phone) }}" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Weight</label>
                                <input type="text" name="weight" value="{{ old('weight', $booking->weight) }}" class="form-control" placeholder="e.g. 5">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Preferred date</label>
                                <input type="date" name="preferred_date" value="{{ old('preferred_date', $booking->preferred_date?->format('Y-m-d')) }}" class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label>Preferred time</label>
                                <input type="text" name="preferred_time" value="{{ old('preferred_time', $booking->preferred_time) }}" class="form-control" placeholder="e.g. 10:00 - 12:00">
                            </div>
                            <div class="col-12 form-group">
                                <label>Notes</label>
                                <textarea name="notes" rows="3" class="form-control">{{ old('notes', $booking->notes) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="row pl-4 pr-4 pt-4">
                        <div class="col-12">
                            <p class="h3 mb-0">Move to workflow</p>
                            <p class="text-muted small mb-0">Confirm with the customer, then move this pickup into the Regular or Express list.</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Weight for Express</label>
                            <input type="number" name="move_weight" value="{{ old('move_weight', is_numeric($booking->weight) ? (int) $booking->weight : '') }}" class="form-control" min="0">
                        </div>
                        <div class="form-group">
                            <label>COD amount</label>
                            <input type="number" step="0.01" name="move_cod_amount" value="{{ old('move_cod_amount', 0) }}" class="form-control" min="0">
                        </div>
                        <div class="form-group">
                            <label>Invoice</label>
                            <input type="text" name="move_invoice" value="{{ old('move_invoice') }}" class="form-control">
                        </div>
                        <div class="form-check mb-3">
                            <input type="hidden" name="move_exchange" value="0">
                            <input type="checkbox" name="move_exchange" value="1" id="move_exchange" class="form-check-input" {{ old('move_exchange') ? 'checked' : '' }}>
                            <label class="form-check-label" for="move_exchange">Exchange parcel</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Save changes</button>

                        @if(! $converted)
                            <button type="submit" name="type" value="regular"
                                formaction="{{ route('pickup.request.guest.move', $booking->id) }}"
                                class="btn btn-outline-success btn-block mt-2">Save &amp; move to Regular</button>
                            <button type="submit" name="type" value="express"
                                formaction="{{ route('pickup.request.guest.move', $booking->id) }}"
                                class="btn btn-outline-dark btn-block mt-2">Save &amp; move to Express</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- end wrapper  -->
@endsection()
