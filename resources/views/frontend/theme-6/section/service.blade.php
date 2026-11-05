<section class="t5-section" id="services">
    <div class="container">
        <div class="text-center mb-5">
            <span class="t5-section-badge">{{ __('levels.our_services') }}</span>
            <h2 class="t5-section-title">{{ __('levels.our_services') }}</h2>
            <p class="t5-section-desc mt-2">{{ settings()->name }} — {{ __('levels.our_services') }}</p>
        </div>
        <div class="row g-4">
            @foreach ($services as $service)
                <div class="col-lg-3 col-md-6">
                    <div class="t5-service-card">
                        <img src="{{ $service->image }}" alt="{{ $service->title }}">
                        <h5>{{ $service->title }}</h5>
                        <p>{!! \Str::limit(strip_tags($service->description), 120, '...') !!}</p>
                        <a href="{{ route('service.details', $service->id) }}" class="btn btn-sm t5-btn-outline mt-3">
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
