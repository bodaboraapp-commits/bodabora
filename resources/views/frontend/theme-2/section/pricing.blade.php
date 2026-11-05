<!-- 8. PRICING SECTION -->
    <section id="pricing" class="py-24 bg-brand-50">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-8">
                <h2 class="text-3xl md:text-5xl font-extrabold text-brand-900 mb-6 tracking-tight">{{ __('levels.delivery_rates') }}
                </h2>
                <p class="text-lg text-gray-600">{{ __('levels.simple_transparent_pricing') }}</p>
            </div>
            <div class="max-w-4xl mx-auto ">
                <!-- Compact Tab Navigation -->
                <div class="flex flex-wrap justify-center gap-2 mb-8">
                    <button data-tab="same-day"
                        class="cursor-pointer tab-btn tab-active px-5 py-2 rounded-lg font-semibold text-sm transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-bolt text-xs"></i> {{ __('levels.same_day') }}
                    </button>
                    <button data-tab="next-day"
                        class="cursor-pointer tab-btn tab-inactive px-5 py-2 rounded-lg font-semibold text-sm transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-calendar-day text-xs"></i> {{ __('levels.next_day') }}
                    </button>
                    <button data-tab="sub-city"
                        class="cursor-pointer tab-btn tab-inactive px-5 py-2 rounded-lg font-semibold text-sm transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-city text-xs"></i> {{ __('levels.sub_city') }}
                    </button>
                    <button data-tab="outside-city"
                        class="cursor-pointer tab-btn tab-inactive px-5 py-2 rounded-lg font-semibold text-sm transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-globe-asia text-xs"></i> {{ __('levels.nationwide') }}
                    </button>
                </div>

                <!-- Compact Pricing Container -->
                <div class="glass-container rounded-2xl p-6 shadow-smooth">

                    <!-- Same Day Tab Content -->
                    <div id="same-day-content" class="tab-content active-tab animate-fade-in">
                        <div class="flex flex-col md:flex-row gap-8 items-start">

                            <div class="w-full md:w-2/3">
                                <div class="flex items-center justify-between mb-5">
                                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                        <i class="fas fa-rocket text-brand-500"></i> {{ __('levels.express') }}
                                    </h3>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider bg-brand-50 text-brand-700 px-2.5 py-1 rounded-md">Within
                                        City</span>
                                </div>

                                <div class="space-y-3">
                                    @foreach ($pricing as $sameDayPrice)
                                        <div
                                            class="bg-white rounded-xl p-3.5 border border-gray-100 price-row flex items-center justify-between group">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 group-hover:bg-brand-50 group-hover:text-brand-600 transition-colors">
                                                    <i class="{{ ['fas fa-envelope', 'fas fa-box', 'fas fa-boxes-stacked', 'fas fa-dolly'][$loop->index % 4] }} text-sm"></i>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900 text-sm">{{ __('levels.up_to') }} {{ $sameDayPrice->weight }}</p>
                                                    <p class="text-xs text-gray-400">{{ @$sameDayPrice->category->title }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-gray-900 text-lg">{{ settings()->currency }} {{ $sameDayPrice->same_day }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div
                                class="w-full md:w-1/3 bg-brand-50 rounded-xl p-6 text-center border border-brand-100 flex flex-col justify-center h-full min-h-[250px]">
                                <i class="fas fa-stopwatch text-3xl text-brand-500 mb-3 animate-pulse"></i>
                                <h4 class="font-bold text-brand-900 text-base mb-2">{{ __('levels.fastest_option') }}</h4>
                                <p class="text-gray-500 text-xs mb-4">{{ __('levels.delivered_within_3_6_hours') }}
                                </p>
                                <div class="bg-white py-2 px-3 rounded-lg border border-brand-100 shadow-sm">
                                    <p
                                        class="text-xs font-semibold text-brand-700 flex items-center justify-center gap-1.5">
                                        <i class="fas fa-shield-alt text-brand-400"></i> {{ __('levels.on_time_guarantee') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Next Day Tab Content -->
                    <div id="next-day-content" class="tab-content hidden animate-fade-in">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="w-full md:w-2/3">
                                <div class="flex items-center justify-between mb-5">
                                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                        <i class="fas fa-calendar-day text-blue-500"></i> {{ __('levels.next_day') }}
                                    </h3>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 px-2.5 py-1 rounded-md">{{ __('levels.economy') }}</span>
                                </div>

                                <div class="space-y-3">
                                    @foreach ($pricing as $nextDayPrice)
                                        <div
                                            class="bg-white rounded-xl p-3.5 border border-gray-100 price-row flex items-center justify-between group">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 group-hover:bg-blue-50 group-hover:text-blue-600 transition-colors">
                                                    <i class="{{ ['fas fa-envelope', 'fas fa-box', 'fas fa-boxes-stacked', 'fas fa-dolly'][$loop->index % 4] }} text-sm"></i>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900 text-sm">{{ __('levels.up_to') }} {{ $nextDayPrice->weight }}</p>
                                                    <p class="text-xs text-gray-400">{{ @$nextDayPrice->category->title }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-gray-900 text-lg">{{ settings()->currency }} {{ $nextDayPrice->next_day }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div
                                class="w-full md:w-1/3 bg-blue-50 rounded-xl p-6 text-center border border-blue-100 flex flex-col justify-center h-full min-h-[250px]">
                                <i class="fas fa-moon text-3xl text-blue-400 mb-3"></i>
                                <h4 class="font-bold text-blue-900 text-base mb-2">{{ __('levels.most_popular') }}</h4>
                                <p class="text-blue-600/70 text-xs mb-4">{{ __('levels.guaranteed_next_business_day') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Sub-City Tab Content -->
                    <div id="sub-city-content" class="tab-content hidden animate-fade-in">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="w-full md:w-2/3">
                                <div class="flex items-center justify-between mb-5">
                                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                        <i class="fas fa-map text-teal-500"></i> {{ __('levels.sub_city') }}
                                    </h3>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider bg-teal-50 text-teal-700 px-2.5 py-1 rounded-md">Metro
                                        Area</span>
                                </div>

                                <div class="space-y-3">
                                    @foreach ($pricing as $subCityPrice)
                                        <div
                                            class="bg-white rounded-xl p-3.5 border border-gray-100 price-row flex items-center justify-between group">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 group-hover:bg-teal-50 group-hover:text-teal-600 transition-colors">
                                                    <i class="{{ ['fas fa-box', 'fas fa-boxes-stacked', 'fas fa-dolly', 'fas fa-truck-fast'][$loop->index % 4] }} text-sm"></i>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900 text-sm">{{ __('levels.up_to') }} {{ $subCityPrice->weight }}</p>
                                                    <p class="text-xs text-gray-400">{{ @$subCityPrice->category->title }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-gray-900 text-lg">{{ settings()->currency }} {{ $subCityPrice->sub_city }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div
                                class="w-full md:w-1/3 bg-teal-50 rounded-xl p-6 text-center border border-teal-100 flex flex-col justify-center h-full min-h-[200px]">
                                <i class="fas fa-location-dot text-3xl text-teal-400 mb-3"></i>
                                <h4 class="font-bold text-teal-900 text-base mb-2">{{ __('levels.extended_reach') }}</h4>
                                <p class="text-teal-600/70 text-xs">{{ __('levels.suburbs_24_36') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Outside-City Tab Content -->
                    <div id="outside-city-content" class="tab-content hidden animate-fade-in">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <div class="w-full md:w-2/3">
                                <div class="flex items-center justify-between mb-5">
                                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                        <i class="fas fa-earth-americas text-purple-500"></i> {{ __('levels.nationwide') }}
                                    </h3>
                                    <span
                                        class="text-[10px] font-bold uppercase tracking-wider bg-purple-50 text-purple-700 px-2.5 py-1 rounded-md">{{ __('levels.inter_city') }}</span>
                                </div>

                                <div class="space-y-3">
                                    @foreach ($pricing as $outsideCityPrice)
                                        <div
                                            class="bg-white rounded-xl p-3.5 border border-gray-100 price-row flex items-center justify-between group">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 group-hover:bg-purple-50 group-hover:text-purple-600 transition-colors">
                                                    <i class="{{ ['fas fa-envelope', 'fas fa-box', 'fas fa-boxes-stacked', 'fas fa-truck-fast'][$loop->index % 4] }} text-sm"></i>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-900 text-sm">{{ __('levels.up_to') }} {{ $outsideCityPrice->weight }}</p>
                                                    <p class="text-xs text-gray-400">{{ @$outsideCityPrice->category->title }}</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="font-bold text-gray-900 text-lg">{{ settings()->currency }} {{ $outsideCityPrice->outside_city }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div
                                class="w-full md:w-1/3 bg-purple-50 rounded-xl p-6 text-center border border-purple-100 flex flex-col justify-center h-full min-h-[250px]">
                                <i class="fas fa-truck-fast text-3xl text-purple-400 mb-3"></i>
                                <h4 class="font-bold text-purple-900 text-base mb-2">{{ __('levels.anywhere') }}</h4>
                                <p class="text-purple-600/70 text-xs">{{ __('levels.secure_country_delivery') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Minimal Footer Notes -->
                <div class="mt-6 flex flex-wrap justify-center gap-4 text-[11px] text-gray-400 font-medium">
                    <span>{{ __('levels.prices_exclude_vat') }}</span>
                    <span class="hidden sm:inline">&bull;</span>
                    <span>{{ __('levels.contact_support_20kg') }}</span>
                </div>
            </div>
        </div>
    </section>
