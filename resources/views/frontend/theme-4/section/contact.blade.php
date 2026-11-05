<!-- CONTACT -->
    <!-- ========================================= -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-contact-gr-bg-from via-contact-gr-bg-via to-contact-gr-bg-to grid lg:grid-cols-2 gap-6 p-6 lg:p-10 shadow-lg">

                <!-- LEFT -->
                <div class="relative z-10">

                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 border border-white/20 text-white text-xs font-semibold">

                        <i class="fa-solid fa-paper-plane"></i>
                        {{ __('levels.contact_us') }}

                    </span>

                    <h2 class="mt-4 text-4xl lg:text-5xl font-bold leading-snug text-white">
                        {{ __('levels.get_in_touch') }}
                    </h2>

                    <p class="mt-3 text-contact-desc-text text-sm leading-6 max-w-md">
                        {{ __('levels.contact_request_intro') }}
                    </p>

                    <div class="mt-6 space-y-3 text-sm text-white/90">

                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope text-contact-emd-text"></i>
                            {{ settings()->email }}
                        </p>

                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-phone text-contact-emd-text"></i>
                            {{ settings()->phone }}
                        </p>

                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-contact-emd-text"></i>
                            {{ settings()->address }}
                        </p>

                    </div>

                </div>

                <!-- FORM -->
                <div class="bg-white rounded-2xl p-5 lg:p-6 text-section-deep-text shadow-md">

                    <h3 class="text-lg font-bold">
                        {{ __('levels.request_a_quote') }}
                    </h3>

                    <div class="grid sm:grid-cols-2 gap-3 mt-4">

                        <input type="text" placeholder="{{ __('levels.enter_name') }}"
                            class="h-11 px-4 rounded-xl border border-contact-input-border outline-none focus:border-contact-input-focus text-sm">

                        <input type="email" placeholder="{{ __('levels.enter_email') }}"
                            class="h-11 px-4 rounded-xl border border-contact-input-border outline-none focus:border-contact-input-focus text-sm">

                    </div>

                    <input type="text" placeholder="{{ __('levels.enter_subject') }}"
                        class="w-full h-11 px-4 rounded-xl border border-contact-input-border outline-none focus:border-contact-input-focus mt-3 text-sm">

                    <textarea rows="4" placeholder="{{ __('levels.enter_your_message') }}"
                        class="w-full p-4 rounded-xl border border-contact-input-border outline-none focus:border-contact-input-focus mt-3 text-sm"></textarea>

                    <button
                        class="cursor-pointer mt-4 w-full py-3 rounded-xl bg-gradient-to-r from-green-700 to-emerald-500 text-white font-semibold text-sm hover:scale-[1.02] transition">

                        {{ __('levels.send_request') }}

                    </button>

                </div>

            </div>

        </div>
    </section>


    <!-- ========================================= -->
