@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$service->title }} | {{ settings()->name }}
@endsection
@section('content')
    <main>
        <section id="services" class="py-20 bg-white">
            <div class="container mx-auto px-6 lg:px-12">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <span class="text-brand-600 font-bold tracking-wider uppercase text-sm">{{ __('levels.our_services') }}</span>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-brand-900 mt-3 mb-6 tracking-tight">
                        {{ @$service->title }}
                    </h2>
                    <div class="w-24 h-1.5 bg-brand-600 mx-auto rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <article class="lg:col-span-2">
                        <div class="hover-lift bg-brand-50 rounded-3xl p-8 border border-brand-100 group">
                            <div class="w-full h-64 md:h-80 bg-white rounded-3xl shadow-sm flex items-center justify-center overflow-hidden mb-8">
                                <img src="{{ $service->image }}" alt="{{ $service->title }}" class="w-full h-full object-contain p-6">
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-brand-900 mb-5">{{ $service->title }}</h3>
                            <div class="text-sm md:text-base text-gray-600 leading-relaxed">
                                {!! $service->description !!}
                            </div>
                        </div>
                    </article>

                    <aside>
                        <div class="hover-lift bg-brand-50 rounded-3xl p-8 border border-brand-100">
                            <h3 class="text-xl font-bold text-brand-900 mb-6">{{ __('levels.latest_services') }}</h3>
                            <div class="space-y-5">
                                @forelse ($latest_services as $latest_service)
                                    <a href="{{ route('service.details', $latest_service->id) }}"
                                        class="flex gap-4 rounded-2xl bg-white p-4 shadow-sm hover:shadow-md transition-shadow">
                                        <img src="{{ $latest_service->image }}" alt="{{ $latest_service->title }}"
                                            class="w-16 h-16 object-contain rounded-xl bg-brand-50 flex-shrink-0">
                                        <span>
                                            <span class="block font-bold text-brand-900">{{ \Str::limit($latest_service->title, 45) }}</span>
                                            <span class="block text-xs text-gray-600 leading-relaxed mt-1">
                                                {!! \Str::limit(strip_tags($latest_service->description), 70, '...') !!}
                                            </span>
                                        </span>
                                    </a>
                                @empty
                                    <div class="rounded-2xl bg-white p-4 text-sm text-gray-600">
                                        {{ __('levels.our_services') }}
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </main>
@endsection
