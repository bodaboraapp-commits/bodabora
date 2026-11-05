@php
    $isHome = request()->routeIs('home');
    $isServices = request()->routeIs('service.details');
    $isTracking = request()->routeIs('tracking.index');
    $isBlog = request()->routeIs('get.blogs') || request()->routeIs('blog.details');
    $isAbout = request()->routeIs('aboutus.index');
    $isContact = request()->routeIs('contact.send.page');

    $desktopNavClass = fn ($active = false) => ($active ? 'font-semibold text-brand-600' : 'text-gray-600 font-medium') . ' hover:text-brand-600 transition-colors';
    $mobileNavClass = fn ($active = false) => 'block rounded-2xl px-4 py-3 text-sm font-semibold hover:bg-emerald-50 transition ' . ($active ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700');
@endphp

<!-- 1. NAVBAR -->
    <header class="sticky top-0 z-[9999] bg-white/95 backdrop-blur-md shadow-sm transition-all duration-300">
        <div class="container mx-auto px-6 lg:px-12 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                   <img src="{{ settings()->logo_image }}" alt="headerLogo" class="w-full h-12 object-contain rounded-lg group-hover:animate-spin-slow transition-transform">
                </a>

                <!-- Menu -->
                <nav class="hidden lg:flex items-center gap-8">
                    <a href="{{ url('/') }}#top" data-theme-nav-section data-nav-key="top"
                        data-active-class="font-semibold text-brand-600"
                        data-inactive-class="text-gray-600 font-medium"
                        class="{{ $desktopNavClass($isHome) }}">{{ __('levels.home') }}</a>
                    <a href="{{ route('ev.invest.index') }}"
                        class="text-green-600 font-bold hover:underline">⚡ ebikeGO</a>
                    <a href="{{ url('/') }}#services"
                        data-theme-nav-section data-nav-key="services"
                        data-active-class="font-semibold text-brand-600"
                        data-inactive-class="text-gray-600 font-medium"
                        class="{{ $desktopNavClass($isServices) }}">{{ __('levels.services') }}</a>
                    <a href="{{ route('tracking.index') }}"
                        class="{{ $desktopNavClass($isTracking) }}">{{ __('levels.tracking') }}</a>
                    <a href="{{ url('/') }}#pricing"
                        data-theme-nav-section data-nav-key="pricing"
                        data-active-class="font-semibold text-brand-600"
                        data-inactive-class="text-gray-600 font-medium"
                        class="{{ $desktopNavClass(false) }}">{{ __('levels.pricing') }}</a>
                    <a href="{{ route('get.blogs') }}"
                        class="{{ $desktopNavClass($isBlog) }}">{{ __('levels.blog') }}</a>
                    <a href="{{ route('aboutus.index') }}"
                        class="{{ $desktopNavClass($isAbout) }}">{{ __('levels.about') }}</a>
                    <a href="{{ route('contact.send.page') }}"
                        class="{{ $desktopNavClass($isContact) }}">{{ __('levels.contact') }}</a>
                </nav>

                <!-- CTA -->
                <div class="hidden lg:flex items-center gap-4">
                    @include('frontend.partials.language-dropdown')
                    <a href="{{ route('login') }}"
                        class="block bg-brand-100 hover:bg-brand-700 text-green-950 px-3 py-2 rounded-md font-normal transition-all">
                        {{ __('levels.login') }}
                    </a>
                    <a href="{{ route('merchant.sign-up') }}"
                        class="block bg-brand-100 hover:bg-brand-700 text-green-950 px-3 py-2 rounded-md font-normal transition-all">
                        {{ __('levels.register') }}
                    </a>
                </div>

                <!-- Mobile menu button -->
                <button id="mobile-menu-button" type="button"
                    class="lg:hidden inline-flex items-center justify-center rounded-xl border border-gray-200 p-2 text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition"
                    aria-expanded="false" aria-controls="mobile-menu">
                    <span class="sr-only">{{ __('levels.open_main_menu') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <div id="mobile-menu"
                class="mobile-menu lg:hidden rounded-3xl border border-emerald-100 bg-white/95 shadow-lg"
                aria-hidden="true">
                <div class="p-5">
                    <nav class="space-y-3" aria-label="{{ __('levels.mobile_navigation') }}">
                        <a href="{{ url('/') }}#top"
                            data-theme-nav-section data-nav-key="top"
                            data-active-class="bg-emerald-50 text-emerald-700"
                            data-inactive-class="text-gray-700"
                            class="{{ $mobileNavClass($isHome) }}">{{ __('levels.home') }}</a>
                        <a href="{{ url('/') }}#services"
                            data-theme-nav-section data-nav-key="services"
                            data-active-class="bg-emerald-50 text-emerald-700"
                            data-inactive-class="text-gray-700"
                            class="{{ $mobileNavClass($isServices) }}">{{ __('levels.services') }}</a>
                        <a href="{{ route('tracking.index') }}"
                            class="{{ $mobileNavClass($isTracking) }}">{{ __('levels.tracking') }}</a>
                        <a href="{{ url('/') }}#pricing"
                            data-theme-nav-section data-nav-key="pricing"
                            data-active-class="bg-emerald-50 text-emerald-700"
                            data-inactive-class="text-gray-700"
                            class="{{ $mobileNavClass(false) }}">{{ __('levels.pricing') }}</a>
                        <a href="{{ route('get.blogs') }}"
                            class="{{ $mobileNavClass($isBlog) }}">{{ __('levels.blog') }}</a>
                        <a href="{{ route('aboutus.index') }}"
                            class="{{ $mobileNavClass($isAbout) }}">{{ __('levels.about') }}</a>
                        <a href="{{ route('contact.send.page') }}"
                            class="{{ $mobileNavClass($isContact) }}">{{ __('levels.contact') }}</a>
                    </nav>

                    <div class="mt-4 grid gap-3">
                        @include('frontend.partials.language-dropdown')
                        <a href="{{ route('login') }}"
                            class="block bg-brand-100 hover:bg-brand-700 text-green-950 px-3 py-2 rounded-md font-normal transition-all">
                            {{ __('levels.login') }}
                        </a>
                        <a href="{{ route('merchant.sign-up') }}"
                            class="block bg-brand-100 hover:bg-brand-700 text-green-950 px-3 py-2 rounded-md font-normal transition-all">
                            {{ __('levels.register') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </header>

@once
    @push('scripts')
        <script>
            (function () {
                const homePath = @json(parse_url(route('home'), PHP_URL_PATH) ?: '/');
                const defaultKey = 'top';
                const links = document.querySelectorAll('[data-theme-nav-section]');

                if (!links.length) {
                    return;
                }

                const normalizePath = (path) => {
                    const normalized = path.replace(/\/+$/, '');
                    return normalized || '/';
                };

                const applyClasses = (link, isActive) => {
                    const activeClasses = (link.dataset.activeClass || '').split(/\s+/).filter(Boolean);
                    const inactiveClasses = (link.dataset.inactiveClass || '').split(/\s+/).filter(Boolean);

                    link.classList.remove(...activeClasses, ...inactiveClasses);
                    link.classList.add(...(isActive ? activeClasses : inactiveClasses));
                };

                const setActiveSection = () => {
                    if (normalizePath(window.location.pathname) !== normalizePath(homePath)) {
                        return;
                    }

                    const activeKey = window.location.hash ? decodeURIComponent(window.location.hash.substring(1)) : defaultKey;

                    links.forEach((link) => {
                        applyClasses(link, link.dataset.navKey === activeKey);
                    });
                };

                setActiveSection();
                window.addEventListener('hashchange', setActiveSection);
            })();
        </script>
    @endpush
@endonce
