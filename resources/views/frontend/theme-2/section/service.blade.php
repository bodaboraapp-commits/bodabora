<!-- 4. SERVICES SECTION -->
<section id="services" class="py-20 bg-white">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-brand-600 font-bold tracking-wider uppercase text-sm">{{ __('levels.our_services') }}</span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-brand-900 mt-3 mb-6 tracking-tight">
                {{ __('levels.our_services') }}
            </h2>
            <div class="w-24 h-1.5 bg-brand-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse ($services as $service)
                <div class="hover-lift bg-brand-50 rounded-3xl p-8 border border-brand-100 group">
                    <div
                        class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-brand-600 text-3xl mb-6 group-hover:scale-110 group-hover:bg-brand-600 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-box"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-brand-900 mb-3">{{ $service->title }}</h3>
                    <p class="text-xs md:text-sm text-gray-600 leading-relaxed">
                        {!! \Str::limit(strip_tags($service->description), 120, '...') !!}
                    </p>
                    <a href="{{ route('service.details', $service->id) }}"
                        class="mt-4 flex items-center text-xs text-brand-600 hover:text-brand-900 transition-colors">
                        Learn <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            @empty
                <div class="md:col-span-2 lg:col-span-4 hover-lift bg-brand-50 rounded-3xl p-8 border border-brand-100 text-center">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-brand-600 text-3xl mb-6 mx-auto">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3 class="text-lg md:text-xl font-bold text-brand-900 mb-3">{{ __('levels.our_services') }}</h3>
                    <p class="text-xs md:text-sm text-gray-600 leading-relaxed">{{ settings()->name }} {{ __('levels.our_services') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
