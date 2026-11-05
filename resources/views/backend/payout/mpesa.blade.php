@extends('backend.partials.master')
@section('title')
   M-Pesa Payment Testing
@endsection
@section('maincontent')
<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}" class="breadcrumb-link">{{ __('levels.dashboard') }}</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Payment</a></li>
                            <li class="breadcrumb-item"><a href="" class="breadcrumb-link active">M-Pesa STK Push</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="h4 mb-4">Test M-Pesa STK Push Payment</h4>
                    <form action="{{ route('mpesa.stk') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="phone">Customer Phone Number (e.g., 2547XXXXXXXX)</label>
                            <input id="phone" type="text" name="phone" placeholder="254712345678" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="amount">Amount (KES)</label>
                            <input id="amount" type="number" name="amount" placeholder="100" class="form-control" required min="1">
                        </div>
                        <div class="form-group text-right pt-3">
                            <button type="submit" class="btn btn-primary px-4">Initiate STK Push</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
