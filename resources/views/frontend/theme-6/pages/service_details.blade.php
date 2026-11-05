@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$service->title }} | {{ settings()->name }}
@endsection
@section('content')
<section class="t5-page-hero">
    <div class="container">
        <h1 class="t5-page-title">{{ $service->title }}</h1>
    </div>
</section>
<section class="t5-page-content">
    <div class="container">
        <div class="row g-5">
            <div class="col-xl-6">
                <div class="t5-contact-card text-center">
                    <img src="{{ $service->image }}" alt="{{ $service->title }}" class="img-fluid mb-4" style="max-height:200px;object-fit:contain;">
                    <div class="page-content text-start">{!! $service->description !!}</div>
                </div>
            </div>
            <div class="col-xl-6">
                <h3 class="fw-bold mb-4">{{ __('levels.latest_services') }}</h3>
                <div class="row g-3">
                    @foreach ($latest_services as $latest_service)
                        <div class="col-sm-6">
                            <div class="t5-service-card p-3">
                                <img src="{{ $latest_service->image }}" alt="{{ $latest_service->title }}" style="max-height:60px;">
                                <h6 class="fw-bold mt-2">{{ $latest_service->title }}</h6>
                                <p class="small mb-2">{!! \Str::limit(strip_tags($latest_service->description), 60) !!}</p>
                                <a href="{{ route('service.details', $latest_service->id) }}" class="btn btn-sm t5-btn-outline"><i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
