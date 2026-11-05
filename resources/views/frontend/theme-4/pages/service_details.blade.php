@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$service->title }} | {{ settings()->name }}
@endsection
@section('content')
    <!-- ========================================= -->
    <!-- SERVICES detail -->
    <!-- ========================================= -->
    <main>
        <section id="services" class="scroll-mt-24 py-28">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto">
                    <p class="text-sm uppercase tracking-[0.35em] font-semibold text-green-600">{{ __('levels.our_services') }}</p>
                    <h2 class="mt-6 text-4xl lg:text-5xl font-black text-section-deep-text">{{ @$service->title }}</h2>
                    <p class="mt-6 text-section-light-text leading-8">{!! \Str::limit(strip_tags($service->description ?? ''), 170) !!}</p>
                </div>

                <div class="mt-20 grid gap-10 lg:grid-cols-[2fr_1fr]">
                    <article class="space-y-10">
                        <div class="rounded-[2rem] overflow-hidden bg-white shadow-xl border border-border-green-100">
                            <div class="w-full h-96 bg-slate-50 flex items-center justify-center">
                                <img src="{{ $service->image }}"
                                    class="w-full h-full object-contain p-10" alt="{{ $service->title }}">
                            </div>

                            <div class="p-10">
                                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-badge-bg text-badge-text text-sm font-semibold">
                                    {{ __('levels.our_services') }}
                                </span>

                                <h3 class="mt-6 text-3xl font-black text-section-text">{{ @$service->title }}</h3>

                                <div class="mt-8 grid gap-6 text-body-text leading-8">
                                    {!! $service->description !!}
                                </div>
                            </div>
                        </div>
                    </article>

                    <aside class="space-y-8">
                        <div class="rounded-[2rem] bg-white p-8 shadow-xl border border-border-green-100">
                            <h4 class="text-xl font-black text-section-text">{{ __('levels.latest_services') }}</h4>
                            <div class="mt-6 space-y-4">
                                @forelse ($latest_services as $latest_service)
                                    <a href="{{ route('service.details', $latest_service->id) }}"
                                        class="flex gap-4 rounded-3xl border border-border-green-100 bg-slate-50 px-5 py-4 hover:bg-green-50 transition">
                                        <img src="{{ $latest_service->image }}" alt="{{ $latest_service->title }}"
                                            class="w-16 h-16 object-contain rounded-2xl bg-white flex-shrink-0">
                                        <span>
                                            <span class="block font-semibold text-section-heading-text">{{ \Str::limit($latest_service->title, 55) }}</span>
                                            <span class="block text-sm text-blog-card-text mt-2">{!! \Str::limit(strip_tags($latest_service->description), 70, '...') !!}</span>
                                        </span>
                                    </a>
                                @empty
                                    <div class="rounded-3xl border border-border-green-100 bg-slate-50 px-5 py-4 text-sm text-blog-card-text">
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

@push('scripts')
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@endsection
