<!-- 3. TRACKING SECTION -->
    <section class="relative z-20 -mt-16 lg:-mt-24 mb-16 px-6">
        <div class="container mx-auto max-w-4xl">
            <div class="bg-white rounded-3xl p-6 lg:p-10 shadow-soft border border-gray-100">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-brand-900">{{ __('levels.track_your_shipment') }}</h2>
                    <p class="text-gray-500 text-sm mt-1">{{ __('levels.tracking_prompt') }}</p>
                </div>
                <form action="{{ route('tracking.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 max-w-3xl mx-auto">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <i class="fas fa-barcode text-brand-400 text-lg"></i>
                        </div>
                        <input type="text" name="id" placeholder="{{ __('levels.enter_tracking_id_example') }}"
                            class="block w-full pl-12 pr-4 py-4 lg:py-5 border-2 border-brand-100 rounded-2xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0 focus:border-brand-600 transition-colors bg-brand-50/50 font-medium text-lg">
                    </div>
                    <button type="submit"
                        class="bg-brand-600 hover:bg-brand-900 text-white px-8 py-4 lg:py-5 rounded-2xl font-bold text-lg transition-colors shadow-md hover:shadow-lg whitespace-nowrap flex items-center justify-center gap-2">
                        Track Now <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
