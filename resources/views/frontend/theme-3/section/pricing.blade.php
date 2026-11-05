<!-- ================= PRICING ================= -->

    <section id="pricing" class="pt-14 pb-10 lg:pb-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-10">
                <span
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100 text-[#16A34A] text-sm font-semibold">
                    {{ __('levels.pricing') }}
                </span>
                <h2 class="mt-4 text-4xl lg:text-5xl font-black text-[#173B35] tracking-tight">
                    {{ __('levels.delivery_rates') }}
                </h2>
                <p class="mt-3 text-gray-500 text-sm max-w-lg mx-auto leading-relaxed">
                    {{ __('levels.simple_transparent_pricing') }}
                </p>
                <p class="mt-2 text-[#16A34A] text-xs font-medium max-w-md mx-auto leading-relaxed">
                    {{ __('levels.all_amounts_in') }} <span class="font-bold">{{ settings()->currency }}</span>.
                </p>
            </div>

            <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 lg:items-start">
                <aside class="w-full lg:w-56 shrink-0 lg:sticky lg:top-24 z-10">
                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 hidden lg:block">{{ __('levels.delivery_type_label') }}</p>
                    <div class="tab-rail mb-0 flex flex-row lg:flex-col flex-nowrap overflow-x-auto lg:overflow-visible w-full pb-1 lg:pb-0.5 -mx-0.5 px-0.5 lg:mx-0 lg:px-0.5"
                        role="tablist" aria-label="{{ __('levels.delivery_type_label') }}">
                        <button type="button" role="tab" aria-selected="true" data-tab="same-day"
                            class="cursor-pointer tab-btn tab-active flex-1 lg:flex-none min-w-[5.5rem] sm:min-w-0 lg:w-full lg:min-w-0 px-2 sm:px-3 lg:px-4 py-2.5 sm:py-3 rounded-lg font-semibold text-[11px] sm:text-sm transition-all duration-200 flex items-center justify-center lg:justify-start gap-1.5 sm:gap-2">
                            <i class="fas fa-bolt text-[10px] sm:text-xs shrink-0"></i><span
                                class="truncate lg:whitespace-normal lg:text-left">{{ __('levels.same_day') }}</span>
                        </button>
                        <button type="button" role="tab" aria-selected="false" data-tab="next-day"
                            class="cursor-pointer tab-btn tab-inactive flex-1 lg:flex-none min-w-[5.5rem] sm:min-w-0 lg:w-full lg:min-w-0 px-2 sm:px-3 lg:px-4 py-2.5 sm:py-3 rounded-lg font-semibold text-[11px] sm:text-sm transition-all duration-200 flex items-center justify-center lg:justify-start gap-1.5 sm:gap-2">
                            <i class="fas fa-calendar-day text-[10px] sm:text-xs shrink-0"></i><span
                                class="truncate lg:whitespace-normal lg:text-left">{{ __('levels.next_day') }}</span>
                        </button>
                        <button type="button" role="tab" aria-selected="false" data-tab="sub-city"
                            class="cursor-pointer tab-btn tab-inactive flex-1 lg:flex-none min-w-[5.5rem] sm:min-w-0 lg:w-full lg:min-w-0 px-2 sm:px-3 lg:px-4 py-2.5 sm:py-3 rounded-lg font-semibold text-[11px] sm:text-sm transition-all duration-200 flex items-center justify-center lg:justify-start gap-1.5 sm:gap-2">
                            <i class="fas fa-city text-[10px] sm:text-xs shrink-0"></i><span
                                class="truncate lg:whitespace-normal lg:text-left">{{ __('levels.sub_city') }}</span>
                        </button>
                        <button type="button" role="tab" aria-selected="false" data-tab="outside-city"
                            class="cursor-pointer tab-btn tab-inactive flex-1 lg:flex-none min-w-[5.5rem] sm:min-w-0 lg:w-full lg:min-w-0 px-2 sm:px-3 lg:px-4 py-2.5 sm:py-3 rounded-lg font-semibold text-[11px] sm:text-sm transition-all duration-200 flex items-center justify-center lg:justify-start gap-1.5 sm:gap-2">
                            <i class="fas fa-globe text-[10px] sm:text-xs shrink-0"></i><span
                                class="truncate lg:whitespace-normal lg:text-left">{{ __('levels.nationwide') }}</span>
                        </button>
                    </div>
                </aside>

                <div
                    class="flex-1 min-w-0 rounded-3xl bg-white border border-emerald-100 shadow-lg shadow-emerald-100/50 p-5 sm:p-8">

                    <!-- Same day -->
                    <div id="same-day-content" class="tab-content">
                        <div class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-emerald-100">
                            <h3 class="text-lg font-black text-[#173B35] flex items-center gap-2">
                                <i class="fas fa-bolt text-emerald-600"></i> {{ __('levels.same_day') }}
                            </h3>
                            <span
                                class="text-xs font-bold uppercase tracking-wide text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                                {{ __('levels.within_city') }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                            @foreach ($pricing as $sameDayPrice)
                                @if (!$loop->last)
                                    <div
                                        class="price-card rounded-2xl border border-emerald-100 bg-white p-4 sm:p-5 flex flex-col justify-between min-h-[120px]">
                                        <p class="text-sm font-semibold text-gray-600">{{ __('levels.up_to') }} {{ $sameDayPrice->weight }}</p>
                                        <small class="text-gray-400">{{ @$sameDayPrice->category->title }}</small>
                                        <p class="text-2xl sm:text-3xl font-black text-gray-900 mt-2">{{ settings()->currency }} {{ $sameDayPrice->same_day }}</p>
                                    </div>
                                @else
                                    <div
                                        class="price-card rounded-2xl border-2 border-emerald-200 gradient-soft p-4 sm:p-5 flex flex-col justify-between min-h-[120px]">
                                        <div class="flex items-start justify-between gap-2">
                                            <p class="text-sm font-semibold text-gray-700">{{ __('levels.up_to') }} {{ $sameDayPrice->weight }}</p>
                                            <span
                                                class="shrink-0 text-[10px] font-bold uppercase tracking-wide bg-emerald-600 text-white px-2 py-0.5 rounded-md">{{ __('levels.bulk') }}</span>
                                        </div>
                                        <small class="text-emerald-700">{{ @$sameDayPrice->category->title }}</small>
                                        <p class="text-2xl sm:text-3xl font-black text-emerald-800 mt-2">{{ settings()->currency }} {{ $sameDayPrice->same_day }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Next day -->
                    <div id="next-day-content" class="tab-content hidden">
                        <div class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-emerald-100">
                            <h3 class="text-lg font-black text-[#173B35] flex items-center gap-2">
                                <i class="fas fa-calendar-day text-emerald-600"></i> {{ __('levels.next_day') }}
                            </h3>
                            <span
                                class="text-xs font-bold uppercase tracking-wide text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                                {{ __('levels.economy') }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                            @foreach ($pricing as $nextDayPrice)
                                <div class="price-card rounded-2xl border border-emerald-100 bg-white p-4 sm:p-5">
                                    <p class="text-sm font-semibold text-gray-600">{{ __('levels.up_to') }} {{ $nextDayPrice->weight }}</p>
                                    <small class="text-gray-400">{{ @$nextDayPrice->category->title }}</small>
                                    <p class="text-2xl sm:text-3xl font-black text-gray-900 mt-2">{{ settings()->currency }} {{ $nextDayPrice->next_day }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sub-city -->
                    <div id="sub-city-content" class="tab-content hidden">
                        <div class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-emerald-100">
                            <h3 class="text-lg font-black text-[#173B35] flex items-center gap-2">
                                <i class="fas fa-city text-emerald-600"></i> {{ __('levels.sub_city') }}
                            </h3>
                            <span
                                class="text-xs font-bold uppercase tracking-wide text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                                {{ __('levels.metro_area') }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4">
                            @foreach ($pricing as $subCityPrice)
                                @if (!$loop->last)
                                    <div class="price-card rounded-2xl border border-emerald-100 bg-white p-4 sm:p-5">
                                        <p class="text-sm font-semibold text-gray-600">{{ __('levels.up_to') }} {{ $subCityPrice->weight }}</p>
                                        <small class="text-gray-400">{{ @$subCityPrice->category->title }}</small>
                                        <p class="text-2xl sm:text-3xl font-black text-gray-900 mt-2">{{ settings()->currency }} {{ $subCityPrice->sub_city }}</p>
                                    </div>
                                @else
                                    <div
                                        class="price-card rounded-2xl border-2 border-emerald-200 gradient-soft p-4 sm:p-5 sm:col-span-1 col-span-2">
                                        <div class="flex items-start justify-between gap-2">
                                            <p class="text-sm font-semibold text-gray-700">{{ __('levels.up_to') }} {{ $subCityPrice->weight }}</p>
                                            <span
                                                class="shrink-0 text-[10px] font-bold uppercase tracking-wide bg-emerald-600 text-white px-2 py-0.5 rounded-md">{{ __('levels.bulk') }}</span>
                                        </div>
                                        <small class="text-emerald-700">{{ @$subCityPrice->category->title }}</small>
                                        <p class="text-2xl sm:text-3xl font-black text-emerald-800 mt-2">{{ settings()->currency }} {{ $subCityPrice->sub_city }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Nationwide -->
                    <div id="outside-city-content" class="tab-content hidden">
                        <div class="flex items-center justify-between gap-3 mb-6 pb-4 border-b border-emerald-100">
                            <h3 class="text-lg font-black text-[#173B35] flex items-center gap-2">
                                <i class="fas fa-globe text-emerald-600"></i> {{ __('levels.nationwide') }}
                            </h3>
                            <span
                                class="text-xs font-bold uppercase tracking-wide text-emerald-700 bg-emerald-100 px-3 py-1 rounded-full">
                                {{ __('levels.inter_city') }}
                            </span>
                        </div>
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                            @foreach ($pricing as $outsideCityPrice)
                                @if (!$loop->last)
                                    <div class="price-card rounded-2xl border border-emerald-100 bg-white p-4 sm:p-5">
                                        <p class="text-sm font-semibold text-gray-600">{{ __('levels.up_to') }} {{ $outsideCityPrice->weight }}</p>
                                        <small class="text-gray-400">{{ @$outsideCityPrice->category->title }}</small>
                                        <p class="text-2xl sm:text-3xl font-black text-gray-900 mt-2">{{ settings()->currency }} {{ $outsideCityPrice->outside_city }}</p>
                                    </div>
                                @else
                                    <div
                                        class="col-span-2 lg:col-span-3 price-card rounded-2xl border border-dashed border-emerald-300 bg-emerald-50/80 p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                        <div class="flex items-start justify-between gap-2 flex-1">
                                            <div>
                                                <p class="text-sm font-semibold text-gray-700">{{ __('levels.up_to') }} {{ $outsideCityPrice->weight }}</p>
                                                <small class="text-emerald-700">{{ @$outsideCityPrice->category->title }}</small>
                                                <p class="text-2xl sm:text-3xl font-black text-gray-900 mt-1">{{ settings()->currency }} {{ $outsideCityPrice->outside_city }}</p>
                                            </div>
                                            <span
                                                class="shrink-0 text-[10px] font-bold uppercase tracking-wide bg-emerald-600 text-white px-2 py-0.5 rounded-md h-fit">{{ __('levels.bulk') }}</span>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex flex-wrap justify-center gap-3 text-xs text-gray-500 font-medium">
                <span>All prices in {{ settings()->currency }}; exclude sales tax/VAT where applicable.</span>
                <span class="hidden sm:inline text-emerald-200">•</span>
                <span>{{ __('levels.above_25_quote') }}</span>
            </div>
        </div>
    </section>
