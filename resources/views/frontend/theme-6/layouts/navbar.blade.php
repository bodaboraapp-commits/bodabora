@php
    $isHome = request()->routeIs('home');
    $isTracking = request()->routeIs('tracking.index');
    $isBlog = request()->routeIs('get.blogs') || request()->routeIs('blog.details');
    $isAbout = request()->routeIs('aboutus.index');
    $isContact = request()->routeIs('contact.send.page');

    $navClass = fn ($active = false) => 'nav-link t5-nav-link' . ($active ? ' active' : '');
@endphp

<header class="t5-navbar">
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ settings()->logo_image }}" alt="{{ settings()->name }}" height="48">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#t5Offcanvas" aria-controls="t5Offcanvas" aria-label="{{ __('levels.toggle_navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="t5Offcanvas" aria-labelledby="t5OffcanvasLabel">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title fw-bold" id="t5OffcanvasLabel">{{ settings()->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="{{ __('levels.close') }}"></button>
                </div>
                <div class="offcanvas-body d-lg-flex align-items-center">
                    <ul class="navbar-nav mx-lg-auto gap-lg-1">
                        <li class="nav-item">
                            <a class="{{ $navClass($isHome) }}" href="{{ url('/') }}" data-theme-nav-section data-nav-key="home" data-active-class="active" data-inactive-class="">{{ __('levels.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success fw-bold" href="{{ route('ev.invest.index') }}">⚡ ebikeGO</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ $navClass(false) }}" href="{{ url('/') }}#pricing" data-theme-nav-section data-nav-key="pricing" data-active-class="active" data-inactive-class="">{{ __('levels.pricing') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ $navClass($isTracking) }}" href="{{ route('tracking.index') }}">{{ __('levels.tracking') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ $navClass($isBlog) }}" href="{{ route('get.blogs') }}">{{ __('levels.blogs') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ $navClass($isAbout) }}" href="{{ route('aboutus.index') }}">{{ __('levels.about') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ $navClass($isContact) }}" href="{{ route('contact.send.page') }}">{{ __('levels.contact') }}</a>
                        </li>
                    </ul>

                    <div class="d-flex flex-column flex-lg-row align-items-stretch align-items-lg-center gap-2 mt-4 mt-lg-0">
                        @include('frontend.partials.language-dropdown')
                        @if(Auth::check())
                            <div class="dropdown">
                                <a class="btn t5-btn-outline dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user me-1"></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('dashboard.index') }}">
                                            <i class="fa fa-home me-2"></i>{{ __('levels.dashboard') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-power-off me-2"></i>{{ __('menus.logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn t5-btn-outline">{{ __('levels.login') }}</a>
                            <a href="{{ route('merchant.sign-up') }}" class="btn t5-btn-primary">{{ __('levels.register') }}</a>
                        @endif
                    </div>

                    <div class="d-lg-none mt-4 pt-3 border-top">
                        <p class="small text-muted mb-2"><i class="fa fa-envelope me-2"></i>{{ settings()->email }}</p>
                        <p class="small text-muted mb-3"><i class="fa fa-phone me-2"></i>{{ settings()->phone }}</p>
                        <div class="d-flex gap-3">
                            @foreach ($social_links as $social)
                                <a href="{{ $social->link }}" class="text-dark" title="{{ $social->name }}"><i class="{{ $social->icon }}"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
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
