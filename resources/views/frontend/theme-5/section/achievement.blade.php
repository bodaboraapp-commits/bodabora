<!-- Statistics -->
  <section class="bg-statistics-bg py-14 sm:py-16 text-statistics-heading-text">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6 text-center">
        <div class="transition-transform duration-300 hover:scale-105">
          <p class="text-4xl sm:text-5xl font-extrabold tabular-nums">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'branch_count') }}</p>
          <p class="mt-2 text-sm font-medium text-statistics-desc-text/90 uppercase tracking-wide">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'branch_title') }}</p>
        </div>
        <div class="transition-transform duration-300 hover:scale-105">
          <p class="text-4xl sm:text-5xl font-extrabold tabular-nums">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'parcel_count') }}</p>
          <p class="mt-2 text-sm font-medium text-statistics-desc-text/90 uppercase tracking-wide">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'parcel_title') }}</p>
        </div>
        <div class="transition-transform duration-300 hover:scale-105">
          <p class="text-4xl sm:text-5xl font-extrabold tabular-nums">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'merchant_count') }}</p>
          <p class="mt-2 text-sm font-medium text-statistics-desc-text/90 uppercase tracking-wide">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'merchant_title') }}</p>
        </div>
        <div class="transition-transform duration-300 hover:scale-105">
          <p class="text-4xl sm:text-5xl font-extrabold tabular-nums">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'reviews_count') }}</p>
          <p class="mt-2 text-sm font-medium text-statistics-desc-text/90 uppercase tracking-wide">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'reviews_title') }}
          </p>
        </div>
      </div>
    </div>
  </section>
