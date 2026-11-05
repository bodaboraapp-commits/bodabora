<!-- ================= BRANDS ================= -->
    <section class="bg-emerald-50 border-y border-emerald-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 text-gray-600 font-bold">
            <div class="swiper theme-3-partner-swiper">
                <div class="swiper-wrapper">
                    @foreach ($partners as $partner)
                        <div class="swiper-slide">
                            <div class="hover:scale-110 transition">
                                <a href="{{ @$partner->link }}" target="_blank" rel="noopener">
                                    <img src="{{ @$partner->image }}" alt="{{ @$partner->name ?? 'Partner' }}" class="h-12">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

@push('styles')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/swiper-bundle.min.css') }}" />
    <style>
        .theme-3-partner-swiper {
            padding: 0.25rem 0;
        }

        .theme-3-partner-swiper .swiper-slide {
            display: flex;
            justify-content: center;
        }

        .theme-3-partner-swiper img {
            max-width: 100%;
            object-fit: contain;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ static_asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script>
        (function () {
            function initTheme3PartnerSlider() {
                if (typeof Swiper === 'undefined') return;

                new Swiper('.theme-3-partner-swiper', {
                    loop: {{ $partners->count() > 6 ? 'true' : 'false' }},
                    rewind: {{ $partners->count() > 6 ? 'false' : 'true' }},
                    watchOverflow: true,
                    speed: 1000,
                    spaceBetween: 40,
                    grabCursor: true,
                    autoplay: {
                        delay: 1600,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    breakpoints: {
                        320: { slidesPerView: 2 },
                        640: { slidesPerView: 3 },
                        1024: { slidesPerView: 5 },
                        1280: { slidesPerView: 6 },
                    },
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initTheme3PartnerSlider);
            } else {
                initTheme3PartnerSlider();
            }
        })();
    </script>
@endpush
