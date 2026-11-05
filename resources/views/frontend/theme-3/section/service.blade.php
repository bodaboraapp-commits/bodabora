<!-- ================= SERVICES ================= -->
<section id="services" class="relative overflow-hidden py-24 bg-gradient-to-r from-emerald-50 to-white">

    <!-- SKY BACKGROUND -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <svg class="cloud cloud1" viewBox="0 0 200 100">
            <path
                d="M60 80C30 80 10 60 10 40C10 20 30 10 50 15C60 0 90 0 100 20C120 10 150 20 150 40C170 40 180 55 180 70C180 85 165 95 150 95H60Z"
                fill="white" opacity="0.8" />
        </svg>

        <svg class="cloud cloud2" viewBox="0 0 200 100">
            <path
                d="M70 85C40 85 20 65 20 45C20 25 40 15 60 20C70 5 100 5 110 25C130 15 160 25 160 45C180 45 190 60 190 75C190 90 175 100 160 100H70Z"
                fill="white" opacity="0.6" />
        </svg>

        <svg class="cloud cloud3" viewBox="0 0 200 100">
            <path
                d="M55 80C25 80 5 60 5 40C5 20 25 10 45 15C55 0 85 0 95 20C115 10 145 20 145 40C165 40 175 55 175 70C175 85 160 95 145 95H55Z"
                fill="white" opacity="0.5" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-2xl mx-auto">
            <span class="inline-block px-4 py-2 rounded-full bg-emerald-100 text-emerald-600 font-semibold text-sm">
                {{ __('levels.our_services') }}
            </span>
            <h2 class="text-4xl lg:text-5xl font-black mt-6 leading-tight">
                {{ __('levels.our_services') }}
            </h2>
            <p class="text-gray-500 mt-5 leading-8">
                {{ settings()->name }} {{ __('levels.our_services') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mt-16">
            @forelse ($services as $service)
                <div class="group bg-white rounded-3xl p-8 border border-emerald-100 hover:-translate-y-2 transition-all duration-300 shadow-lg hover:shadow-2xl">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-400 text-white flex items-center justify-center text-3xl overflow-hidden">
                        <img src="{{ $service->image }}" alt="{{ $service->title }}" class="w-full h-full object-contain bg-white p-2">
                    </div>
                    <h3 class="mt-7 font-bold text-xl">
                        {{ $service->title }}
                    </h3>
                    <p class="mt-4 text-gray-500 leading-7">
                        {!! \Str::limit(strip_tags($service->description), 120, '...') !!}
                    </p>
                    <a href="{{ route('service.details', $service->id) }}"
                        class="block text-emerald-600 font-semibold text-sm hover:text-emerald-700 mt-4">
                        Read More &rarr;
                    </a>
                </div>
            @empty
                <div class="md:col-span-2 lg:col-span-4 group bg-white rounded-3xl p-8 border border-emerald-100 shadow-lg text-center">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-400 text-white flex items-center justify-center text-3xl mx-auto">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h3 class="mt-7 font-bold text-xl">{{ __('levels.our_services') }}</h3>
                    <p class="mt-4 text-gray-500 leading-7">{{ settings()->name }} {{ __('levels.our_services') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
