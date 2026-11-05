<!-- 9. CTA SECTION -->
    <section class="py-20">
        <div class="container mx-auto px-6 lg:px-12">
            <div
                class="bg-gradient-to-r from-brand-600 to-brand-800 rounded-[2.5rem] p-12 md:p-16 text-center shadow-2xl relative overflow-hidden">
                <!-- Abstract BG shapes inside CTA -->
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-brand-400 rounded-full blur-3xl opacity-30 transform translate-x-1/2 -translate-y-1/2">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-64 h-64 bg-brand-900 rounded-full blur-3xl opacity-30 transform -translate-x-1/2 translate-y-1/2">
                </div>

                <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6 relative z-10 tracking-tight">{{ __('levels.need_fast_delivery') }} <br class="hidden md:block">{{ __('levels.start_shipping_today') }}</h2>
                <p class="text-brand-100 text-lg mb-10 max-w-2xl mx-auto relative z-10">{{ __('levels.cta_join_text') }}</p>
                <a href="{{ url('/') }}#pricing"
                    class="inline-block bg-white text-brand-900 px-6 md:px-10 py-3 md:py-4 rounded-full font-bold md:font-extrabold text-base md:text-lg transition-transform hover:scale-105 shadow-xl relative z-10">
                    {{ __('levels.get_started_now') }}
                </a>
            </div>
        </div>
    </section>
