<section class="t5-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="t5-section-badge">{{ __('levels.our_partner') }}</span>
            <h2 class="t5-section-title">{{ __('levels.our_partner') }}</h2>
        </div>
        <div class="t5-partner">
            <div class="swiper">
                <div class="swiper-wrapper">
                    @foreach ($partners as $partner)
                        <div class="swiper-slide">
                            <a href="{{ $partner->link }}" target="_blank" rel="noopener">
                                <img src="{{ $partner->image }}" alt="Partner" class="partner-logo">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination position-relative mt-4"></div>
            </div>
        </div>
    </div>
</section>
