@php
    $isHome = request()->routeIs('home');
    $isServices = request()->routeIs('service.details');
    $isTracking = request()->routeIs('tracking.index');
    $isBlog = request()->routeIs('get.blogs') || request()->routeIs('blog.details');
    $isAbout = request()->routeIs('aboutus.index');
    $isContact = request()->routeIs('contact.send.page');

    $desktopNavClass = fn ($active = false) => 'py-2 px-3 rounded-2xl hover:text-nav-active-text hover:bg-nav-active-bg transition ' . ($active ? 'text-nav-active-text bg-nav-active-bg' : '');
    $mobileNavClass = fn ($active = false) => 'px-4 py-3 rounded-xl hover:text-nav-active-text hover:bg-nav-active-bg transition ' . ($active ? 'text-nav-active-text bg-nav-active-bg' : '');
@endphp

<!-- NAVBAR -->
    <!-- ========================================= -->
    <header x-data="{ mobileMenuOpen: false }"
        class="w-full sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-border-green-100">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="h-20 flex items-center justify-between">

                <!-- Logo -->

                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <img src="{{ settings()->logo_image }}" alt="headerLogo"
                        class="w-full h-12 object-contain rounded-lg group-hover:animate-spin-slow transition-transform">
                </a>

                <!-- Menu -->

                <nav class="hidden lg:flex items-center gap-1 text-sm font-medium">

                    <a href="{{ url('/') }}#home"
                        data-theme-nav-section data-nav-key="home"
                        data-active-class="text-nav-active-text bg-nav-active-bg"
                        data-inactive-class=""
                        class="{{ $desktopNavClass($isHome) }}">
                        {{ __('levels.home') }}
                    </a>

                    <a href="{{ route('ev.invest.index') }}"
                        class="px-3 py-2 rounded-lg text-green-600 font-bold hover:bg-gray-100">
                        ⚡ ebikeGO
                    </a>

                    <a href="{{ route('tracking.index') }}"
                        class="{{ $desktopNavClass($isTracking) }}">
                        {{ __('levels.tracking') }}
                    </a>

                    <a href="{{ url('/') }}#services"
                        data-theme-nav-section data-nav-key="services"
                        data-active-class="text-nav-active-text bg-nav-active-bg"
                        data-inactive-class=""
                        class="{{ $desktopNavClass($isServices) }}">
                        {{ __('levels.services') }}
                    </a>

                    <a href="{{ url('/') }}#pricing"
                        data-theme-nav-section data-nav-key="pricing"
                        data-active-class="text-nav-active-text bg-nav-active-bg"
                        data-inactive-class=""
                        class="{{ $desktopNavClass(false) }}">
                        {{ __('levels.pricing') }}
                    </a>
                    <a href="{{ route('aboutus.index') }}"
                        class="{{ $desktopNavClass($isAbout) }}">
                        {{ __('levels.about') }}
                    </a>
                    <a href="{{ route('get.blogs') }}"
                        class="{{ $desktopNavClass($isBlog) }}">
                        {{ __('levels.blog') }}
                    </a>
                    <a href="{{ route('contact.send.page') }}"
                        class="{{ $desktopNavClass($isContact) }}">
                        {{ __('levels.contact') }}
                    </a>

                </nav>

                <!-- Button -->

                <div class="hidden lg:flex items-center gap-4">

                    @include('frontend.partials.language-dropdown')
                    <a href="{{ route('login') }}"
                        class="cursor-pointer px-4 py-2 text-sm rounded-md bg-button-bg-light text-section-heading-text font-normal hover:scale-105 transition-all duration-300">
                        log in
                    </a>
                    <a href="{{ route('merchant.sign-up') }}"
                        class="cursor-pointer px-4 py-2 text-sm rounded-md bg-button-bg-light text-section-heading-text font-normal hover:scale-105 transition-all duration-300">
                        {{ __('levels.register') }}
                    </a>

                </div>

                <!-- Mobile -->

                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden p-2 rounded-xl hover:bg-green-50 transition"
                    :aria-expanded="mobileMenuOpen.toString()" aria-controls="mobile-nav"
                    aria-label="{{ __('levels.toggle_mobile_menu') }}">
                    <svg x-show="!mobileMenuOpen" x-transition.opacity xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" x-transition.opacity x-cloak xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>

            <!-- Mobile Menu -->
            <div id="mobile-nav" x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
                class="lg:hidden pb-6 border-t border-border-green-100 mt-1">
                <nav class="flex flex-col pt-5 gap-2 text-sm font-semibold">
                    <a @click="mobileMenuOpen = false" href="{{ url('/') }}#home"
                        data-theme-nav-section data-nav-key="home"
                        data-active-class="text-nav-active-text bg-nav-active-bg"
                        data-inactive-class=""
                        class="{{ $mobileNavClass($isHome) }}">
                        {{ __('levels.home') }}
                    </a>
                    <a @click="mobileMenuOpen = false" href="{{ route('tracking.index') }}"
                        class="{{ $mobileNavClass($isTracking) }}">
                        {{ __('levels.tracking') }}
                    </a>
                    <a @click="mobileMenuOpen = false" href="{{ url('/') }}#services"
                        data-theme-nav-section data-nav-key="services"
                        data-active-class="text-nav-active-text bg-nav-active-bg"
                        data-inactive-class=""
                        class="{{ $mobileNavClass($isServices) }}">
                        {{ __('levels.services') }}
                    </a>
                    <a @click="mobileMenuOpen = false" href="{{ url('/') }}#pricing"
                        data-theme-nav-section data-nav-key="pricing"
                        data-active-class="text-nav-active-text bg-nav-active-bg"
                        data-inactive-class=""
                        class="{{ $mobileNavClass(false) }}">
                        {{ __('levels.pricing') }}
                    </a>
                    <a @click="mobileMenuOpen = false" href="{{ route('aboutus.index') }}"
                        class="{{ $mobileNavClass($isAbout) }}">
                        {{ __('levels.about') }}
                    </a>
                    <a @click="mobileMenuOpen = false" href="{{ route('get.blogs') }}"
                        class="{{ $mobileNavClass($isBlog) }}">
                        {{ __('levels.blog') }}
                    </a>
                    <a @click="mobileMenuOpen = false" href="{{ route('contact.send.page') }}"
                        class="{{ $mobileNavClass($isContact) }}">
                        {{ __('levels.contact') }}
                    </a>
                </nav>
                <div class="mt-4">
                    @include('frontend.partials.language-dropdown')
                </div>
                <a href="{{ route('login') }}"
                    class="cursor-pointer mt-4 w-full px-4 py-2 rounded-full bg-button-bg-light text-white font-semibold hover:scale-[1.01] transition-all duration-300">
                    log in
                </a>
                <a href="{{ route('merchant.sign-up') }}"
                    class="cursor-pointer mt-4 w-full px-4 py-2 rounded-full bg-button-bg-light text-white font-semibold hover:scale-[1.01] transition-all duration-300">
                    {{ __('levels.register') }}
                </a>
            </div>

        </div>

    </header>

@once
    @push('scripts')
        <script>
            (function () {
                const homePath = @json(parse_url(route('home'), PHP_URL_PATH) ?: '/');
                const defaultKey = 'home';
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
