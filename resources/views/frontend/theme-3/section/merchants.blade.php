<!-- Merchants section -->
  <section id="being-merchants" class="scroll-mt-28 py-16 sm:py-20 bg-white">
    <div class="container mx-auto px-4">
      <div class="grid gap-10 lg:grid-cols-2 lg:gap-14 items-center">
        <div class="order-2 lg:order-1">
          <img src="{{ section(\App\Enums\SectionType::GALLERY,'gallery_image_2') ?: static_asset('frontend/theme-3/image/gps-back.png') }}" alt="{{ __('levels.merchants') }}"
            class="h-[480px] w-full rounded-xl object-cover shadow-xl shadow-emerald-900/10 aspect-[4/3] transition-transform duration-500 hover:scale-[1.01]" />
        </div>
        <div class="order-1 lg:order-2">
          <h2 class="text-2xl sm:text-3xl font-extrabold text-section-heading-text tracking-tight">{{ __('levels.merchants') }}</h2>
          <p class="mt-5 text-base leading-relaxed text-section-desc-text max-w-prose">
            {{ __('levels.cta_join_text') }}
          </p>
          <a href="{{ route('merchant.sign-up') }}"
            class="mt-8 inline-flex items-center gap-2 rounded-lg bg-button-bg px-6 py-3 text-sm font-semibold text-button-text shadow-md shadow-emerald-600/25 hover:bg-button-hover-bg hover:shadow-lg transition-all duration-300">
            {{ __('levels.become_a_merchant') }}
            <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  </section>
