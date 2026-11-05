<!-- PRICING -->
    <!-- ========================================= -->
    <section id="pricing" class="pb-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-10">
                <span
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-badge-bg text-badge-text text-sm font-semibold">
                    {{ __('levels.pricing') }}
                </span>
                <h2 class="mt-4 text-3xl sm:text-4xl font-black text-section-deep-text tracking-tight">
                    {{ __('levels.delivery_rates') }}
                </h2>
                <p class="mt-3 text-section-light-text text-sm max-w-lg mx-auto leading-relaxed">
                    {{ __('levels.simple_transparent_pricing') }}
                </p>
                <p class="mt-2 text-section-heading-text text-xs font-medium max-w-md mx-auto leading-relaxed">
                    {{ __('levels.all_amounts_in') }} <span class="font-bold">{{ settings()->currency }}</span>.
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-2 mb-8">
                <button type="button" data-tab="same-day"
                    class="cursor-pointer pricing-tab-btn pricing-tab-active px-4 sm:px-5 py-2.5 rounded-full font-semibold text-sm transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-bolt text-xs"></i> {{ __('levels.same_day') }}
                </button>
                <button type="button" data-tab="next-day"
                    class="cursor-pointer pricing-tab-btn pricing-tab-inactive px-4 sm:px-5 py-2.5 rounded-full font-semibold text-sm transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-calendar-day text-xs"></i> {{ __('levels.next_day') }}
                </button>
                <button type="button" data-tab="sub-city"
                    class="cursor-pointer pricing-tab-btn pricing-tab-inactive px-4 sm:px-5 py-2.5 rounded-full font-semibold text-sm transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-city text-xs"></i> {{ __('levels.sub_city') }}
                </button>
                <button type="button" data-tab="outside-city"
                    class="cursor-pointer pricing-tab-btn pricing-tab-inactive px-4 sm:px-5 py-2.5 rounded-full font-semibold text-sm transition-all duration-200 flex items-center gap-2">
                    <i class="fas fa-globe text-xs"></i> {{ __('levels.nationwide') }}
                </button>
            </div>

            <div class="rounded-3xl bg-white border border-border-green-100 shadow-lg shadow-green-100/50 p-5 sm:p-8">

                <!-- Same day -->
                <div id="same-day-content" class="pricing-tab-panel">
                    <div class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-border-green-100">
                        <h3 class="text-lg font-black text-section-deep-text flex items-center gap-2">
                            <i class="fas fa-bolt text-pricing-card-icon"></i> {{ __('levels.same_day') }}
                        </h3>
                        <span
                            class="text-xs font-bold uppercase tracking-wide text-badge-text bg-badge-bg px-3 py-1 rounded-full">
                            {{ __('levels.within_city') }}
                        </span>
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                        @foreach ($pricing as $sameDayPrice)
                            @if (!$loop->last)
                                <div
                                    class="gb-pricing-tile rounded-2xl border border-border-green-100 bg-white p-4 sm:p-5 flex flex-col justify-between min-h-[120px]">
                                    <p class="text-sm font-semibold text-pricing-card-grid-text-p">{{ __('levels.up_to') }} {{ $sameDayPrice->weight }}</p>
                                    <small class="text-section-light-text">{{ @$sameDayPrice->category->title }}</small>
                                    <p class="text-2xl sm:text-3xl font-black text-pricing-card-grid-text-p mt-2">{{ settings()->currency }} {{ $sameDayPrice->same_day }}</p>
                                </div>
                            @else
                                <div
                                    class="gb-pricing-tile rounded-2xl border-2 border-green-200 gb-surface-soft p-4 sm:p-5 flex flex-col justify-between min-h-[120px]">
                                    <div class="flex items-start justify-between gap-2">
                                        <p class="text-sm font-semibold text-pricing-card-grid-text-p">{{ __('levels.up_to') }} {{ $sameDayPrice->weight }}</p>
                                        <span
                                            class="shrink-0 text-[10px] font-bold uppercase tracking-wide bg-green-600 text-white px-2 py-0.5 rounded-md">{{ __('levels.bulk') }}</span>
                                    </div>
                                    <small class="text-section-heading-text">{{ @$sameDayPrice->category->title }}</small>
                                    <p class="text-2xl sm:text-3xl font-black text-pricing-card-grid-text-p mt-2">{{ settings()->currency }} {{ $sameDayPrice->same_day }}</p>
                                </div>
                            @endif
                        @endforeach
                   
                    </div>
                </div>

                <!-- Next day -->
                <div id="next-day-content" class="pricing-tab-panel hidden">
                    <div class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-border-green-100">
                        <h3 class="text-lg font-black text-section-deep-text flex items-center gap-2">
                            <i class="fas fa-calendar-day text-pricing-card-icon"></i> {{ __('levels.next_day') }}
                        </h3>
                        <span
                            class="text-xs font-bold uppercase tracking-wide text-badge-text bg-badge-bg px-3 py-1 rounded-full">
                            {{ __('levels.economy') }}
                        </span>
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                        @foreach ($pricing as $nextDayPrice)
                            <div class="gb-pricing-tile rounded-2xl border border-border-green-100 bg-white p-4 sm:p-5">
                                <p class="text-sm font-semibold text-pricing-card-grid-text-p">{{ __('levels.up_to') }} {{ $nextDayPrice->weight }}</p>
                                <small class="text-section-light-text">{{ @$nextDayPrice->category->title }}</small>
                                <p class="text-2xl sm:text-3xl font-black text-pricing-card-grid-text-p mt-2">{{ settings()->currency }} {{ $nextDayPrice->next_day }}</p>
                            </div>
                        @endforeach
                    
                    </div>
                </div>

                <!-- Sub-city -->
                <div id="sub-city-content" class="pricing-tab-panel hidden">
                    <div class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-border-green-100">
                        <h3 class="text-lg font-black text-section-deep-text flex items-center gap-2">
                            <i class="fas fa-city text-pricing-card-icon"></i> {{ __('levels.sub_city') }}
                        </h3>
                        <span
                            class="text-xs font-bold uppercase tracking-wide text-badge-text bg-badge-bg px-3 py-1 rounded-full">
                            {{ __('levels.metro_area') }}
                        </span>
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                        @foreach ($pricing as $subCityPrice)
                            @if (!$loop->last)
                                <div class="gb-pricing-tile rounded-2xl border border-border-green-100 bg-white p-4 sm:p-5">
                                    <p class="text-sm font-semibold text-pricing-card-grid-text-p">{{ __('levels.up_to') }} {{ $subCityPrice->weight }}</p>
                                    <small class="text-section-light-text">{{ @$subCityPrice->category->title }}</small>
                                    <p class="text-2xl sm:text-3xl font-black text-pricing-card-grid-text-p mt-2">{{ settings()->currency }} {{ $subCityPrice->sub_city }}</p>
                                </div>
                            @else
                                <div
                                    class="gb-pricing-tile rounded-2xl border-2 border-green-200 gb-surface-soft p-4 sm:p-5 sm:col-span-1 col-span-2">
                                    <div class="flex items-start justify-between gap-2">
                                        <p class="text-sm font-semibold text-pricing-card-grid-text-p">{{ __('levels.up_to') }} {{ $subCityPrice->weight }}</p>
                                        <span
                                            class="shrink-0 text-[10px] font-bold uppercase tracking-wide bg-pricing-card-icon text-white px-2 py-0.5 rounded-md">{{ __('levels.bulk') }}</span>
                                    </div>
                                    <small class="text-section-heading-text">{{ @$subCityPrice->category->title }}</small>
                                    <p class="text-2xl sm:text-3xl font-black text-pricing-card-grid-text-p mt-2">{{ settings()->currency }} {{ $subCityPrice->sub_city }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Nationwide -->
                <div id="outside-city-content" class="pricing-tab-panel hidden">
                    <div class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-border-green-100">
                        <h3 class="text-lg font-black text-section-deep-text flex items-center gap-2">
                            <i class="fas fa-globe text-pricing-card-icon"></i> {{ __('levels.nationwide') }}
                        </h3>
                        <span
                            class="text-xs font-bold uppercase tracking-wide text-badge-text bg-badge-bg px-3 py-1 rounded-full">
                            {{ __('levels.inter_city') }}
                        </span>
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                        @foreach ($pricing as $outsideCityPrice)
                            @if (!$loop->last)
                                <div class="gb-pricing-tile rounded-2xl border border-border-green-100 bg-white p-4 sm:p-5">
                                    <p class="text-sm font-semibold text-pricing-card-grid-text-w">{{ __('levels.up_to') }} {{ $outsideCityPrice->weight }}</p>
                                    <small class="text-section-light-text">{{ @$outsideCityPrice->category->title }}</small>
                                    <p class="text-2xl sm:text-3xl font-black text-pricing-card-grid-text-p mt-2">{{ settings()->currency }} {{ $outsideCityPrice->outside_city }}</p>
                                </div>
                            @else
                                <div
                                    class="col-span-2 lg:col-span-3 gb-pricing-tile rounded-2xl border border-dashed border-green-300 bg-green-50/80 p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <div class="flex items-start justify-between gap-2 flex-1">
                                        <div>
                                            <p class="text-sm font-semibold text-pricing-card-grid-text-w">{{ __('levels.up_to') }} {{ $outsideCityPrice->weight }}</p>
                                            <small class="text-section-heading-text">{{ @$outsideCityPrice->category->title }}</small>
                                            <p class="text-2xl sm:text-3xl font-black text-pricing-card-grid-text-p mt-1">{{ settings()->currency }} {{ $outsideCityPrice->outside_city }}</p>
                                        </div>
                                        <span
                                            class="shrink-0 text-[10px] font-bold uppercase tracking-wide bg-green-600 text-white px-2 py-0.5 rounded-md h-fit">{{ __('levels.bulk') }}</span>
                                    </div>
                                
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </section>

    <!-- ========================================= -->
