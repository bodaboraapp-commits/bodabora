<!-- ================= HOW IT WORKS ================= -->
    <section class="py-24 relative overflow-hidden">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center max-w-2xl mx-auto">
                <h2 class="text-4xl lg:text-5xl font-black">
                    {{ __('levels.why') }} {{ settings()->name }}
                </h2>

                <p class="text-gray-500 mt-5 leading-8">
                    Simple and fast delivery process designed for businesses and
                    customers worldwide.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mt-20">
                @foreach ($whycouriers as $whycourier)
                    <div
                        class="group bg-white rounded-3xl p-8 border border-emerald-100 hover:-translate-y-2 transition-all duration-300 shadow-lg hover:shadow-2xl">

                        <div
                            class="w-16 h-16 rounded-2xl bg-emerald-400 text-white flex items-center justify-center text-3xl">
                            <img src="{{ $whycourier->image }}" alt="{{ $whycourier->title }}" class="w-10 h-10 object-contain">
                        </div>

                        <h3 class="mt-7 font-bold text-xl">
                            {{ $whycourier->title }}
                        </h3>

                        @if (!empty($whycourier->description))
                            <p class="mt-4 text-gray-500 leading-7">
                                {{ $whycourier->description }}
                            </p>
                        @endif
                        <a href="{{ url('/#services') }}"
                            class="block text-emerald-600 font-semibold text-sm hover:text-emerald-700 mt-4">Read More →</a>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
