<!-- SERVICES -->
<!-- ========================================= -->
<section id="services" class="scroll-mt-24 py-28">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <span
                class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-badge-bg text-badge-text text-sm font-semibold">
                {{ __('levels.our_services') }}
            </span>

            <h2 class="mt-6 text-4xl lg:text-5xl font-black text-section-deep-text">
                {{ __('levels.our_services') }}
            </h2>

            <p class="mt-6 text-section-light-text leading-8">
                {{ settings()->name }} {{ __('levels.our_services') }}
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mt-20">
            @forelse ($services as $service)
                <div
                    class="{{ $loop->iteration === 2 ? 'rounded-3xl p-10 gb-surface-hero text-white shadow-2xl shadow-green-300 gb-card-lift relative overflow-hidden' : 'bg-white rounded-3xl p-10 shadow-lg border border-border-green-100 gb-card-lift hover:shadow-2xl' }}">
                    @if ($loop->iteration === 2)
                        <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    @endif

                    <div
                        class="{{ $loop->iteration === 2 ? 'w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center text-3xl backdrop-blur overflow-hidden' : 'w-16 h-16 rounded-2xl gb-surface-soft flex items-center justify-center text-3xl shadow overflow-hidden' }}">
                        <img src="{{ $service->image }}" alt="{{ $service->title }}" class="w-full h-full object-contain bg-white p-2">
                    </div>

                    <h3 class="{{ $loop->iteration === 2 ? 'mt-7 text-2xl font-black' : 'mt-7 text-2xl font-black text-section-deep-text' }}">
                        {{ $service->title }}
                    </h3>

                    <p class="{{ $loop->iteration === 2 ? 'mt-5 text-green-50 leading-8' : 'mt-5 text-section-light-text leading-8' }}">
                        {!! \Str::limit(strip_tags($service->description), 120, '...') !!}
                    </p>

                    <a href="{{ route('service.details', $service->id) }}"
                        class="{{ $loop->iteration === 2 ? 'block mt-7 font-semibold' : 'block mt-7 text-section-text font-semibold' }}">
                        Learn More &rarr;
                    </a>
                </div>
            @empty
                <div
                    class="md:col-span-2 lg:col-span-3 bg-white rounded-3xl p-10 shadow-lg border border-border-green-100 gb-card-lift text-center">
                    <div class="w-16 h-16 rounded-2xl gb-surface-soft flex items-center justify-center text-3xl shadow mx-auto">
                        <i class="fa-solid fa-box-open text-services-card-icon"></i>
                    </div>
                    <h3 class="mt-7 text-2xl font-black text-section-deep-text">{{ __('levels.our_services') }}</h3>
                    <p class="mt-5 text-section-light-text leading-8">{{ settings()->name }} {{ __('levels.our_services') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ========================================= -->
