<!-- ================= WHY CHOOSE US ================= -->
  <section class="py-16 bg-gradient-to-br from-choose-bg-gr-from to-choose-bg-gr-to relative overflow-hidden">

    <div class="absolute inset-0 opacity-10">
      <img src="{{ section(\App\Enums\SectionType::GALLERY,'gallery_image_4') ?: section(\App\Enums\SectionType::BANNER,'banner_theme_5') }}"
        class="w-full h-full object-cover" alt="">
    </div>

    <div class="relative container mx-auto px-4">

      <div class="text-center max-w-3xl mx-auto">

        <h2 class="mt-4 text-4xl md:text-5xl font-black text-white">
          {{ __('levels.why') }} {{ settings()->name }}
        </h2>

        <p class="mt-5 text-choose-desc-text leading-8">
          {{ __('levels.cta_join_text') }}
        </p>
      </div>

      <!-- Cards -->
      <div class="mt-12 grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($whycouriers as $whycourier)
          <div class="bg-white rounded-3xl p-10 hover:-translate-y-2 transition-all duration-500 shadow-xl text-center">

            <div
              class="w-16 h-16 rounded-2xl bg-choose-card-icon-bg text-choose-card-icon flex items-center justify-center text-2xl mx-auto">
              <img src="{{ $whycourier->image }}" alt="{{ $whycourier->title }}" class="w-10 h-10 object-contain">
            </div>

            <h3 class="mt-5 text-2xl font-bold text-choose-card-head-text">
              {{ $whycourier->title }}
            </h3>

            @if (!empty($whycourier->description))
              <p class="mt-3 text-choose-card-desc-text leading-8">
                {{ $whycourier->description }}
              </p>
            @endif

          </div>
        @endforeach

      </div>

    </div>

  </section>
