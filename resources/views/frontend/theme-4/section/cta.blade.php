<!-- CTA -->
    <!-- ========================================= -->

    <section class="pb-22">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div
                class="rounded-3xl gb-surface-hero p-12 lg:p-16 flex flex-col lg:flex-row items-center justify-between gap-10 text-white shadow-2xl shadow-cta-card-shadow">

                <div>

                    <h2 class="text-4xl lg:text-5xl font-black leading-tight">
                        {{ __('levels.start_shipping_today') }}
                    </h2>

                    <p class="mt-5 text-cta-card-desc-text text-lg">
                        {{ __('levels.cta_join_text') }}
                    </p>

                </div>

                <a href="{{ route('merchant.sign-up') }}"
                    class="cursor-pointer px-8 py-4 rounded-2xl bg-white text-green-700 font-black hover:scale-105 transition-all duration-300 shadow-xl">

                    {{ __('levels.get_started_now') }}

                </a>

            </div>

        </div>

    </section>

    <!-- ========================================= -->
