@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$service->title }} | {{ settings()->name }}
@endsection
@section('content')
    <main class="py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto">
                <span class="inline-block px-4 py-2 rounded-full bg-emerald-100 text-emerald-600 font-semibold text-sm">
                    {{ __('levels.our_services') }}
                </span>
                <h2 class="text-4xl lg:text-5xl font-black mt-6">
                    {{ @$service->title }}
                </h2>
                <p class="text-gray-500 mt-5 leading-8">
                    {!! \Str::limit(strip_tags($service->description), 160, '...') !!}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mt-16">
                <aside class="lg:col-span-1">
                    <h3 class="text-xl font-bold mb-4">{{ __('levels.latest_services') }}</h3>
                    <div class="space-y-4">
                        @forelse ($latest_services as $latest_service)
                            <div class="bg-white rounded-lg shadow p-3 hover:shadow-md transition-shadow">
                                <a href="{{ route('service.details', $latest_service->id) }}"
                                    class="block h-24 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded mb-3 overflow-hidden">
                                    <img src="{{ $latest_service->image }}" alt="{{ $latest_service->title }}" class="w-full h-full object-contain p-2" />
                                </a>
                                <h4 class="font-semibold text-sm">{{ \Str::limit($latest_service->title, 45) }}</h4>
                                <p class="text-xs text-gray-500 mt-1">{!! \Str::limit(strip_tags($latest_service->description), 60, '...') !!}</p>
                                <a href="{{ route('service.details', $latest_service->id) }}" class="text-xs text-emerald-600 font-semibold mt-2 hover:underline">Read &rarr;</a>
                            </div>
                        @empty
                            <div class="bg-white rounded-lg shadow p-3 text-sm text-gray-500">
                                {{ __('levels.our_services') }}
                            </div>
                        @endforelse
                    </div>
                </aside>

                <article class="lg:col-span-3">
                    <div class="bg-white rounded-2xl shadow p-8">
                        <div
                            class="h-72 md:h-96 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-xl mb-8 flex items-center justify-center overflow-hidden">
                            <img src="{{ $service->image }}" alt="{{ $service->title }}" class="w-full h-full object-contain p-8" />
                        </div>

                        <div class="mb-6">
                            <span
                                class="inline-block bg-emerald-50 text-emerald-600 text-xs font-semibold px-3 py-1 rounded-full mb-3">{{ __('levels.our_services') }}</span>
                            <h1 class="text-4xl font-extrabold mb-3">{{ @$service->title }}</h1>
                        </div>

                        <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed space-y-4">
                            {!! $service->description !!}
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </main>
@push('scripts')
    <style>
        .animate-fade-in {
            animation: fadeIn 0.25s ease-out;
        }

        .mobile-menu {
            max-height: 0;
            opacity: 0;
            transform: translateY(-8px);
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease, transform 0.3s ease;
        }

        .mobile-menu.open {
            max-height: 900px;
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        function setMobileMenuState(isOpen) {
            mobileMenu.classList.toggle('open', isOpen);
            mobileMenu.setAttribute('aria-hidden', String(!isOpen));
            mobileMenuButton.setAttribute('aria-expanded', String(isOpen));
        }

        mobileMenuButton?.addEventListener('click', () => {
            setMobileMenuState(!mobileMenu.classList.contains('open'));
        });

        mobileMenu?.querySelectorAll('a, button').forEach(item => {
            item.addEventListener('click', () => setMobileMenuState(false));
        });
    </script>
@endpush
@endsection
