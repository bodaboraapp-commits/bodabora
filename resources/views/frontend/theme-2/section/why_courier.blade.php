<!-- 5. HOW IT WORKS -->
    <section class="py-24 bg-brand-50">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-extrabold text-brand-900 mb-6 tracking-tight">{{ __('levels.why') }} {{ settings()->name }}</h2>
                <p class="text-lg text-gray-600">{{ __('levels.send_parcels_steps') }}</p>
            </div>

            <div class="grid md:grid-cols-4 gap-12 text-center relative z-10">
                @foreach ($whycouriers as $whycourier)
                    <div class="step-container">
                        <div
                            class="relative w-20 h-20 mx-auto {{ $loop->iteration === 3 ? 'bg-brand-600 shadow-glow border-brand-400' : 'bg-white shadow-md border-brand-100' }} rounded-2xl border-2 flex items-center justify-center mb-6 z-10 hover:scale-110 transition-transform cursor-pointer">
                            <img src="{{ $whycourier->image }}" alt="{{ $whycourier->title }}" class="w-10 h-10 object-contain">
                            <div
                                class="absolute -top-3 -right-3 w-8 h-8 bg-brand-900 text-white rounded-full flex items-center justify-center font-bold border-4 border-brand-50 shadow-sm">
                                {{ $loop->iteration }}</div>
                        </div>
                        <h4 class="text-xl font-bold text-brand-900 mb-2">{{ $whycourier->title }}</h4>
                        @if (!empty($whycourier->description))
                            <p class="text-gray-500 text-sm">{{ $whycourier->description }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
