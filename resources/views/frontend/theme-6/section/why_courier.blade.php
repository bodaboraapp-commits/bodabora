<section class="t5-section t5-section-alt">
    <div class="container">
        <div class="text-center mb-5">
            <span class="t5-section-badge">{{ __('levels.why') }}</span>
            <h2 class="t5-section-title">{{ __('levels.why') }} {{ settings()->name }}</h2>
        </div>
        <div class="row g-4">
            @foreach ($whycouriers as $whycourier)
                <div class="col-lg-4 col-md-6">
                    <div class="t5-why-card">
                        <img src="{{ $whycourier->image }}" alt="{{ $whycourier->title }}" class="img-fluid">
                        <h5 class="fw-bold mt-3">{{ $whycourier->title }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
