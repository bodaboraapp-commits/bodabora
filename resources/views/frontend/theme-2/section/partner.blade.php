<!-- PARTNER BRANDS -->
<section class="py-20 bg-white relative overflow-hidden">
    <div class="absolute top-10 left-10 w-64 h-64 bg-brand-200 rounded-full blur-3xl opacity-30 -z-10 pointer-events-none">
    </div>
    <div class="absolute bottom-10 right-10 w-80 h-80 bg-brand-100 rounded-full blur-3xl opacity-40 -z-10 pointer-events-none">
    </div>

    <div class="container mx-auto px-6 lg:px-12">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-brand-600 font-bold tracking-wider uppercase text-sm">{{ __('levels.our_partner') }}</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-brand-900 mt-3 mb-6 tracking-tight">
                {{ __('levels.our_partner') }}
            </h2>
            <div class="w-24 h-1.5 bg-brand-600 mx-auto rounded-full"></div>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed mt-6">
                Trusted partners who help us deliver fast, secure, and reliable courier service every day.
            </p>
        </div>

        <div class="swiper theme-2-partner-swiper max-w-7xl mx-auto">
            <div class="swiper-wrapper">
                @foreach ($partners as $partner)
                    <div class="swiper-slide">
                        <a href="{{ @$partner->link }}" target="_blank" rel="noopener"
                            class="hover-lift bg-brand-50 rounded-3xl p-8 border border-brand-100 flex items-center justify-center h-20 group">
                            <img src="{{ @$partner->image }}" alt="{{ @$partner->name ?? 'Partner' }}"
                                class="h-12 opacity-70 group-hover:opacity-100 transition-all duration-300">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination theme-2-partner-pagination"></div>
        </div>
    </div>
</section>

@push('styles')
    <link rel="stylesheet" href="{{ static_asset('frontend/css/swiper-bundle.min.css') }}" />
    <style>
        .theme-2-partner-swiper {
            padding: 0.5rem 0 3rem;
        }

        .theme-2-partner-swiper img {
            max-width: 100%;
            object-fit: contain;
        }

        .theme-2-partner-swiper .swiper-pagination {
            bottom: 0;
        }

        .theme-2-partner-swiper .swiper-pagination-bullet-active {
            background: #16A34A;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ static_asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script>
        (function () {
            function initTheme2PartnerSlider() {
                if (typeof Swiper === 'undefined') return;

                new Swiper('.theme-2-partner-swiper', {
                    loop: {{ $partners->count() > 4 ? 'true' : 'false' }},
                    rewind: {{ $partners->count() > 4 ? 'false' : 'true' }},
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
                        el: '.theme-2-partner-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        320: { slidesPerView: 2 },
                        640: { slidesPerView: 3 },
                        1024: { slidesPerView: 4 },
                    },
                });
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initTheme2PartnerSlider);
            } else {
                initTheme2PartnerSlider();
            }
        })();
    </script>
@endpush
