<!-- PARTNERS -->
<!-- ========================================= -->
<section class="pb-28">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-badge-bg text-badge-text text-sm font-semibold">
                {{ __('levels.our_partner') }}
            </span>

            <h2 class="mt-6 text-4xl lg:text-5xl font-black text-section-deep-text">
                {{ __('levels.our_partner') }}
            </h2>

            <p class="mt-6 text-section-light-text leading-8">
                Trusted by businesses and merchants for fast, secure, and reliable courier delivery.
            </p>
        </div>

        <div class="mt-16 rounded-3xl bg-white border border-border-green-100 shadow-lg shadow-green-100/50 p-5 sm:p-8">
            <div class="swiper theme-4-partner-swiper">
                <div class="swiper-wrapper">
                    @foreach ($partners as $partner)
                        <div class="swiper-slide">
                            <a href="{{ @$partner->link }}" target="_blank" rel="noopener"
                                class="h-20 rounded-2xl gb-surface-soft border border-border-green-100 flex items-center justify-center p-5 gb-card-lift">
                                <img src="{{ @$partner->image }}" alt="{{ @$partner->name ?? 'Partner' }}" class="h-12">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination theme-4-partner-pagination"></div>
            </div>
        </div>
    </div>
</section>

@push('styles')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/swiper-bundle.min.css') }}" />
    <style>
        .theme-4-partner-swiper {
            padding: 0.25rem 0 3rem;
        }

        .theme-4-partner-swiper img {
            max-width: 100%;
            object-fit: contain;
        }

        .theme-4-partner-swiper .swiper-pagination {
            bottom: 0;
        }

        .theme-4-partner-swiper .swiper-pagination-bullet-active {
            background: #16A34A;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ static_asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script>
        (function () {
            function initTheme4PartnerSlider() {
                if (typeof Swiper === 'undefined') return;

                new Swiper('.theme-4-partner-swiper', {
                    loop: {{ $partners->count() > 5 ? 'true' : 'false' }},
                    rewind: {{ $partners->count() > 5 ? 'false' : 'true' }},
                    watchOverflow: true,
                    speed: 900,
                    spaceBetween: 24,
                    grabCursor: true,
                    autoplay: {
                        delay: 1800,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    pagination: {
                        el: '.theme-4-partner-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        320: { slidesPerView: 2 },
                        640: { slidesPerView: 3 },
                        1024: { slidesPerView: 5 },
                    },
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initTheme4PartnerSlider);
            } else {
                initTheme4PartnerSlider();
            }
        })();
    </script>
@endpush
