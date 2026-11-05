<!-- FAQ -->
    <!-- ========================================= -->
    <section class="pb-28" x-data="{ active: 1 }">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid lg:grid-cols-2 gap-16 items-start">

                <!-- Left -->
                <div>

                    <span
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-badge-bg text-badge-text text-sm font-semibold">
                        FAQ
                    </span>

                    <h2 class="mt-6 text-4xl lg:text-5xl font-black leading-tight text-section-deep-text">
                        Frequently asked questions.
                    </h2>

                    <p class="mt-6 text-lg text-section-light-text leading-relaxed max-w-lg">
                        Find answers to the most common questions about our courier and parcel delivery
                        services.
                    </p>

                    <button
                        class="cursor-pointer mt-10 px-8 py-4 rounded-2xl bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold shadow-xl shadow-green-200 hover:scale-105 transition-all duration-300">
                        Talk To Us
                    </button>

                </div>

                <!-- Right -->
                <div class="space-y-5">

                    @foreach ($faqs as $key => $faq)
                        <!-- Item -->
                        <div
                            class="bg-white rounded-3xl border border-border-green-100 shadow-sm overflow-hidden transition-all duration-300">

                            <button @click="active = active === {{ $loop->iteration }} ? null : {{ $loop->iteration }}"
                                class="w-full flex items-center justify-between p-6 text-left cursor-pointer">

                                <span class="font-semibold text-lg text-faq-ques-text">
                                    {{ @$faq->question }}
                                </span>

                                <span
                                    class="w-10 h-10 rounded-full bg-faq-icon-bg flex items-center justify-center text-faq-icon-text text-xl font-bold transition duration-300"
                                    :class="active === {{ $loop->iteration }} ? 'rotate-45' : ''">
                                    +
                                </span>

                            </button>

                            <div x-show="active === {{ $loop->iteration }}" x-collapse>
                                <div class="px-6 pb-6 text-faq-ans-text leading-relaxed">
                                    {!! $faq->answer !!}
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </section>


    <!-- ========================================= -->
