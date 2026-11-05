<!-- ================= SPECIALITIES ================= -->
    <section class="py-24">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center">
                <h2 class="text-4xl lg:text-5xl font-black">
                    {{ __('levels.why_courier') }}
                </h2>

                <p class="text-gray-500 mt-5">
                    {{ __('levels.trusted_by_happy_customers') }}
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8 mt-16">

                @foreach ($whycouriers as $whycourier)
                    @if ($loop->iteration <= 3)
                        <!-- Box -->
                        <div
                            class="bg-white rounded-3xl border border-gray-100 p-10 hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">

                            <span class="text-5xl font-black text-emerald-100">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>

                            <h3 class="mt-6 text-2xl font-bold">
                                {{ $whycourier->title }}
                            </h3>

                            <p class="mt-5 text-gray-500 leading-8">
                                {{ \Illuminate\Support\Str::limit(strip_tags($whycourier->description ?? ''), 120) }}
                            </p>

                        </div>
                    @endif
                @endforeach

            </div>

        </div>
    </section>
