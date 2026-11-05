@php
    $isHome = request()->routeIs('home');
    $isTracking = request()->routeIs('tracking.index');
    $isBlog = request()->routeIs('get.blogs') || request()->routeIs('blog.details');
    $isAbout = request()->routeIs('aboutus.index');
    $isContact = request()->routeIs('contact.send.page');

    $desktopNavClass = fn ($active = false) => 'transition relative ' . ($active ? 'text-[#16A34A] border-b-2 border-[#16A34A]' : 'hover:text-emerald-500');
    $mobileNavClass = fn ($active = false) => 'block rounded-2xl px-4 py-3 text-sm font-semibold hover:bg-emerald-50 transition ' . ($active ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700');
@endphp

<!-- ================= NAVBAR ================= -->
    <header class="w-full bg-white/90 backdrop-blur sticky top-0 z-[999] border-b border-green-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <img src="{{ settings()->logo_image }}" alt="cc Logo" style="width: 160px; height: 48px; object-fit: contain;">

                </div>

                <!-- Menu -->
                <nav class="hidden lg:flex items-center gap-10 text-sm font-medium">
                    <a href="{{ url('/') }}#top" data-theme-nav-section data-nav-key="top"
                        data-active-class="text-[#16A34A] border-b-2 border-[#16A34A]"
                        data-inactive-class="hover:text-emerald-500"
                        class="{{ $desktopNavClass($isHome) }}">{{ __('levels.home') }}</a>
                    <a href="{{ route('ev.invest.index') }}" class="text-emerald-600 font-bold hover:underline">⚡ ebikeGO</a>
                    <a href="{{ route('agents.index') }}" class="{{ $desktopNavClass(request()->routeIs('agents.index')) }}">Agents</a>
                    <a href="{{ route('tracking.index') }}" class="{{ $desktopNavClass($isTracking) }}">{{ __('levels.tracking') }}</a>
                    <a href="{{ url('/') }}#pricing" data-theme-nav-section data-nav-key="pricing"
                        data-active-class="text-[#16A34A] border-b-2 border-[#16A34A]"
                        data-inactive-class="hover:text-emerald-500"
                        class="{{ $desktopNavClass(false) }}">{{ __('levels.pricing') }}</a>
                    <a href="{{ route('aboutus.index') }}" class="{{ $desktopNavClass($isAbout) }}">{{ __('levels.about') }}</a>
                    <a href="{{ route('get.blogs') }}" class="{{ $desktopNavClass($isBlog) }}">{{ __('levels.blog') }}</a>
                    <a href="{{ route('contact.send.page') }}" class="{{ $desktopNavClass($isContact) }}">{{ __('levels.contact') }}</a>
                </nav>

                <!-- Buttons -->
                <div class="hidden lg:flex items-center gap-4">
                    @include('frontend.partials.language-dropdown')

                    @auth
                        <a href="{{ route('dashboard.index') }}"
                            class="block cursor-pointer bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-2 rounded-xl text-sm font-semibold transition">
                            {{ __('levels.dashboard') }}
                        </a>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}"
                            class="block cursor-pointer bg-emerald-200 hover:bg-emerald-500 text-brand-800 px-6 py-2 rounded-xl text-sm transition">
                            {{ __('levels.sign_in') }}
                        </a>
                        <a href="{{ route('merchant.sign-up') }}"
                            class="block cursor-pointer bg-emerald-200 hover:bg-emerald-500 text-brand-800 px-6 py-2 rounded-xl text-sm transition">
                            {{ __('levels.register') }}
                        </a>
                    @endguest
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
                        <a href="{{ route('tracking.index') }}"
                            class="{{ $mobileNavClass($isTracking) }}">{{ __('levels.tracking') }}</a>
                        <a href="{{ route('agents.index') }}"
                            class="{{ $mobileNavClass(request()->routeIs('agents.index')) }}">Agents</a>
                        <a href="{{ url('/') }}#pricing"
                            data-theme-nav-section data-nav-key="pricing"
                            data-active-class="bg-emerald-50 text-emerald-700"
                            data-inactive-class="text-gray-700"
                            class="{{ $mobileNavClass(false) }}">{{ __('levels.pricing') }}</a>
                        <a href="{{ route('aboutus.index') }}"
                            class="{{ $mobileNavClass($isAbout) }}">{{ __('levels.about') }}</a>
                        <a href="{{ route('get.blogs') }}"
                            class="{{ $mobileNavClass($isBlog) }}">{{ __('levels.blog') }}</a>
                        <a href="{{ route('contact.send.page') }}"
                            class="{{ $mobileNavClass($isContact) }}">{{ __('levels.contact') }}</a>
                    </nav>

                    <div class="mt-4 grid gap-3">
                        @include('frontend.partials.language-dropdown')
                        @auth
                            <a href="{{ route('dashboard.index') }}"
                                class="block w-full rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2 text-sm font-semibold transition">
                                {{ __('levels.dashboard') }}
                            </a>
                        @endauth
                        @guest
                            <a href="{{ route('merchant.sign-up') }}"
                                class="block w-full rounded-2xl bg-emerald-200 hover:bg-emerald-500 text-white px-5 py-2 text-sm font-semibold transition">
                                {{ __('levels.register') }}
                            </a>
                            <a href="{{ route('login') }}"
                                class="block w-full rounded-2xl bg-emerald-200 hover:bg-emerald-500 text-white px-5 py-2 text-sm font-semibold transition">
                                {{ __('levels.sign_in') }}
                            </a>
                        @endguest
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
