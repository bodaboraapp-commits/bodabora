<!-- Partner logos -->
  <section class="bg-white py-10 sm:py-12" aria-label="{{ __('levels.our_partner') }}">
    <div class="container mx-auto px-4">
      <div class="swiper theme-5-partner-swiper">
        <div class="swiper-wrapper">

          @foreach ($partners as $partner)
            <div class="swiper-slide">
              <a href="{{ @$partner->link }}" target="_blank" rel="noopener"
                class="flex items-center justify-center">
                <img src="{{ @$partner->image }}" alt="{{ @$partner->name ?? 'Partner' }}"
                  class="h-8 sm:h-10 object-contain grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition duration-300 partner-logo" />
              </a>
            </div>
          @endforeach

        </div>

      </div>
    </div>
  </section>

@push('styles')
  <link rel="stylesheet" href="{{ static_asset('frontend/css/swiper-bundle.min.css') }}" />
  <style>
    .theme-5-partner-swiper {
      padding: 0.25rem 0;
    }

    .theme-5-partner-swiper .swiper-slide {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .theme-5-partner-swiper img {
      max-width: 100%;
    }
  </style>
@endpush

@push('scripts')
  <script src="{{ static_asset('frontend/js/swiper-bundle.min.js') }}"></script>
  <script>
    (function () {
      function initTheme5PartnerSlider() {
        if (typeof Swiper === 'undefined') return;

        new Swiper('.theme-5-partner-swiper', {
          loop: {{ $partners->count() > 6 ? 'true' : 'false' }},
          rewind: {{ $partners->count() > 6 ? 'false' : 'true' }},
          watchOverflow: true,
          speed: 900,
          spaceBetween: 32,
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
        document.addEventListener('DOMContentLoaded', initTheme5PartnerSlider);
      } else {
        initTheme5PartnerSlider();
      }
    })();
  </script>
@endpush
