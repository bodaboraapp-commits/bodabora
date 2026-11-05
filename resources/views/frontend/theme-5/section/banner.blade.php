<!-- ================= HERO ================= -->
@php
  $bannerImage = section(\App\Enums\SectionType::BANNER,'banner_theme_5') ?: static_asset('frontend/theme-5/image/herobg.jpg');
@endphp
  <section id="hero-section" class="relative overflow-hidden">

    <div class="absolute inset-0">
      @if($bannerImage)
        <img src="{{ $bannerImage }}" class="w-full h-full object-cover" alt="{{ settings()->name }}">
      @endif
      <div class="absolute inset-0 bg-hero-overlay/60"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-28">

      <div class="max-w-3xl">

        <span
          class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-badge-bg/20 border border-badge-border text-badge-text text-sm font-semibold backdrop-blur">
          <i class="fa-solid fa-truck"></i>
          {{ settings()->name }}
        </span>

        <h2 class="mt-8 text-5xl md:text-6xl leading-tight font-semibold text-white">
          {{ section(\App\Enums\SectionType::BANNER,'title_1') }}
          {{ section(\App\Enums\SectionType::BANNER,'title_2') }}
          {{ section(\App\Enums\SectionType::BANNER,'title_3') }}
        </h2>

        <p class="mt-6 text-lg text-hero-description-text leading-8">
          {{ section(\App\Enums\SectionType::BANNER,'sub_title') }}
        </p>

      </div>

    </div>

  </section>
