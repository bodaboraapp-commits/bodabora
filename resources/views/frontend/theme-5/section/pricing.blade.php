<!-- ================= pricing ================= -->
  <section id="pricing" class="py-12 lg:py-18 bg-white">
    <div class="max-w-3xl mx-auto px-5">
      <!-- Tiny header (minimal) -->
      <div class="text-center mb-8">
        <h2 class="text-2xl sm:text-3xl font-extrabold text-section-heading-text tracking-tight">{{ __('levels.delivery_rates') }}</h2>
        <p class="mt-4 text-sm sm:text-base text-section-desc-text leading-relaxed">{{ __('levels.simple_pricing_taxes_excluded') }}
        </p>
      </div>

      <!-- Tab Navigation (emerald series, compact) -->
      <div class="flex flex-wrap justify-center gap-2 mb-7">
        <button data-tab="same-day"
          class="tab-btn-emerald tab-active-emerald cursor-pointer px-5 py-2 rounded-xl font-semibold text-xs sm:text-sm transition-all duration-200 flex items-center gap-1.5 shadow-sm">
          <i class="fas fa-bolt text-[11px]"></i> <span>{{ __('levels.same_day') }}</span>
        </button>
        <button data-tab="next-day"
          class="tab-btn-emerald tab-inactive-emerald cursor-pointer px-5 py-2 rounded-xl font-semibold text-xs sm:text-sm transition-all duration-200 flex items-center gap-1.5">
          <i class="fas fa-calendar-day text-[11px]"></i> <span>{{ __('levels.next_day') }}</span>
        </button>
        <button data-tab="sub-city"
          class="tab-btn-emerald tab-inactive-emerald cursor-pointer px-5 py-2 rounded-xl font-semibold text-xs sm:text-sm transition-all duration-200 flex items-center gap-1.5">
          <i class="fas fa-city text-[11px]"></i> <span>{{ __('levels.sub_city') }}</span>
        </button>
        <button data-tab="outside-city"
          class="tab-btn-emerald tab-inactive-emerald cursor-pointer px-5 py-2 rounded-xl font-semibold text-xs sm:text-sm transition-all duration-200 flex items-center gap-1.5">
          <i class="fas fa-globe-asia text-[11px]"></i> <span>{{ __('levels.nationwide') }}</span>
        </button>
      </div>

      <!-- Compact Container: TWO-COLUMN GRID (pricing only, no side cards) -->
      <div class="bg-white rounded-2xl border border-border-green-100 shadow-sm overflow-hidden">

        <!-- Same Day Tab - two column grid -->
        <div id="same-day-content" class="tab-content-emerald animate-fade-up p-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach ($pricing as $sameDayPrice)
              <div class="price-row-compact border border-border-green-100 p-3.5 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <div
                    class="w-8 h-8 bg-pricing-icon-bg rounded-lg flex items-center justify-center text-pricing-icon-text">
                    <i class="{{ ['fas fa-envelope', 'fas fa-box', 'fas fa-boxes-stacked', 'fas fa-dolly'][$loop->index % 4] }} text-xs"></i>
                  </div>
                  <div>
                    <p class="font-bold text-section-deep-text text-sm">{{ __('levels.up_to') }} {{ $sameDayPrice->weight }}</p>
                    <p class="text-[10px] text-gray-400">{{ @$sameDayPrice->category->title }}</p>
                  </div>
                </div>
                <p class="font-black text-xl text-pricing-dollar-text">{{ settings()->currency }} {{ $sameDayPrice->same_day }}</p>
              </div>
            @endforeach
          </div>
          <div
            class="mt-4 pt-3 text-center text-[11px] text-gray-400 border-t border-border-green-100 flex justify-center gap-3">
            <span><i class="far fa-clock text-pricing-footer-text"></i> {{ __('levels.delivery_3_6h') }}</span>
            <span><i class="fas fa-shield-alt text-pricing-footer-text"></i> {{ __('levels.guaranteed') }}</span>
          </div>
        </div>

        <!-- Next Day Tab - two column grid -->
        <div id="next-day-content" class="tab-content-emerald hidden animate-fade-up p-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach ($pricing as $nextDayPrice)
              <div class="price-row-compact border border-border-green-100 p-3.5 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <div class="w-8 h-8 bg-pricing-icon-bg rounded-lg flex items-center justify-center"><i
                      class="{{ ['fas fa-envelope', 'fas fa-box', 'fas fa-boxes-stacked', 'fas fa-dolly'][$loop->index % 4] }} text-pricing-icon-text text-xs"></i></div>
                  <div>
                    <p class="font-bold text-sm">{{ __('levels.up_to') }} {{ $nextDayPrice->weight }}</p>
                    <p class="text-[10px] text-gray-400">{{ @$nextDayPrice->category->title }}</p>
                  </div>
                </div>
                <p class="font-black text-xl text-pricing-dollar-text">{{ settings()->currency }} {{ $nextDayPrice->next_day }}</p>
              </div>
            @endforeach
          </div>
          <div
            class="mt-4 pt-3 text-center text-[11px] text-gray-400 border-t border-border-green-100 flex justify-center gap-3">
            <span><i class="fas fa-calendar-week text-pricing-footer-text"></i> {{ __('levels.next_business_day') }}</span>
            <span><i class="fas fa-chart-line text-pricing-footer-text"></i> Most popular</span>
          </div>
        </div>

        <!-- Sub-City Tab - two column grid -->
        <div id="sub-city-content" class="tab-content-emerald hidden animate-fade-up p-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach ($pricing as $subCityPrice)
              <div class="price-row-compact border border-border-green-100 p-3.5 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <div class="w-8 h-8 bg-pricing-icon-bg rounded-lg flex items-center justify-center"><i
                      class="{{ ['fas fa-box', 'fas fa-boxes-stacked', 'fas fa-dolly', 'fas fa-truck-fast'][$loop->index % 4] }} text-pricing-icon-text text-xs"></i></div>
                  <div>
                    <p class="font-bold text-sm">{{ __('levels.up_to') }} {{ $subCityPrice->weight }}</p>
                    <p class="text-[10px] text-gray-400">{{ @$subCityPrice->category->title }}</p>
                  </div>
                </div>
                <p class="font-black text-xl text-pricing-dollar-text">{{ settings()->currency }} {{ $subCityPrice->sub_city }}</p>
              </div>
            @endforeach
          </div>
          <div
            class="mt-4 pt-3 text-center text-[11px] text-gray-400 border-t border-border-green-100 flex justify-center gap-3">
            <span><i class="fas fa-location-dot text-pricing-footer-text"></i> {{ __('levels.delivery_24_36h') }}</span>
            <span><i class="fas fa-check-circle text-pricing-footer-text"></i> {{ __('levels.door_to_door') }}</span>
          </div>
        </div>

        <!-- Nationwide Tab - two column grid -->
        <div id="outside-city-content" class="tab-content-emerald hidden animate-fade-up p-5">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach ($pricing as $outsideCityPrice)
              <div class="price-row-compact border border-border-green-100 p-3.5 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                  <div class="w-8 h-8 bg-pricing-icon-bg rounded-lg flex items-center justify-center"><i
                      class="{{ ['fas fa-envelope', 'fas fa-box', 'fas fa-boxes-stacked', 'fas fa-truck-fast'][$loop->index % 4] }} text-pricing-icon-text text-xs"></i></div>
                  <div>
                    <p class="font-bold text-sm">{{ __('levels.up_to') }} {{ $outsideCityPrice->weight }}</p>
                    <p class="text-[10px] text-gray-400">{{ @$outsideCityPrice->category->title }}</p>
                  </div>
                </div>
                <p class="font-black text-xl text-pricing-dollar-text">{{ settings()->currency }} {{ $outsideCityPrice->outside_city }}</p>
              </div>
            @endforeach
          </div>
          <div
            class="mt-4 pt-3 text-center text-[11px] text-gray-400 border-t border-border-green-100 flex justify-center gap-3">
            <span><i class="fas fa-globe text-pricing-footer-text"></i> {{ __('levels.days_2_3') }}</span>
            <span><i class="fas fa-shield-alt text-pricing-footer-text"></i> {{ __('levels.insured') }}</span>
          </div>
        </div>
      </div>

      <!-- Tiny footer note (minimal) -->
      <div class="mt-5 text-center text-[10px] text-gray-400 flex justify-center gap-3 flex-wrap">
        <span>{{ __('levels.excludes_vat') }}</span>
        <span class="hidden sm:inline">•</span>
        <span>{{ __('levels.contact_for_25kg') }}</span>
        <span class="hidden sm:inline">•</span>
        <span><i class="far fa-credit-card text-emerald-300"></i> {{ __('levels.secure') }}</span>
      </div>
    </div>
  </section>
