@php
    $isHome = request()->routeIs('home');
    $isTracking = request()->routeIs('tracking.index');
    $isBlog = request()->routeIs('get.blogs') || request()->routeIs('blog.details');
    $isAbout = request()->routeIs('aboutus.index');
    $isContact = request()->routeIs('contact.send.page');

    $activeNavClasses = 'bg-nav-bg text-nav-active-text border-b-2 border-active-border';
    $desktopNavClass = fn ($active = false) => 'px-3 py-2 rounded-md hover:bg-nav-bg hover:text-nav-active-text transition-colors duration-300 ' . ($active ? $activeNavClasses : '');
    $mobileNavClass = fn ($active = false) => 'rounded-md px-3 py-2.5 hover:bg-nav-bg hover:text-nav-active-text transition-colors duration-300 ' . ($active ? $activeNavClasses : '');
@endphp

<!-- 1. Top bar -->
  <div class="bg-top-bar-bg text-white/90 text-xs sm:text-sm py-2.5 px-8">
    <div class="container mx-auto flex flex-wrap items-center justify-between gap-y-2 gap-x-4">
      <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
        <a href="tel:{{ settings()->phone }}"
          class="inline-flex items-center gap-1.5 hover:text-white transition-colors duration-300">
          <i class="fa-solid fa-phone text-[10px] sm:text-xs opacity-80" aria-hidden="true"></i>
          <span>{{ settings()->phone }}</span>
        </a>
        <a href="mailto:{{ settings()->email }}"
          class="inline-flex items-center gap-1.5 hover:text-white transition-colors duration-300">
          <i class="fa-solid fa-envelope text-[10px] sm:text-xs opacity-80" aria-hidden="true"></i>
          <span class="hidden min-[380px]:inline">{{ settings()->email }}</span>
          <span class="min-[380px]:hidden">{{ __('levels.email_us') }}</span>
        </a>
      </div>
      <div class="flex items-center gap-4 sm:gap-6">
        <a href="{{ route('aboutus.index') }}" class="hover:text-white transition-colors duration-300 font-medium">{{ __('levels.about_us') }}</a>
      </div>
    </div>
  </div>

  <!-- Main nav -->


  <header class="sticky top-0 z-50 shadow-sm border-b border-border-green-100/80 backdrop-blur-sm bg-white/95">
    <div class="container mx-auto px-4">
      <div class="flex items-center justify-between gap-4 py-3.5 lg:py-4">
        <a href="{{ url('/') }}" class="flex items-center gap-2 shrink-0 group">
          <img src="{{ settings()->logo_image }}" alt="headerLogo"
            class="rounded-lg group-hover:animate-spin-slow transition-transform"
            style="width: 128px; height: 40px; object-fit: contain;">
        </a>

        <nav class="hidden xl:flex flex-1 justify-center items-center gap-1 text-sm font-semibold text-nav-text">
          <a href="{{ url('/') }}#hero-section"
            data-theme-nav-section data-nav-key="hero-section"
            data-active-class="{{ $activeNavClasses }}"
            data-inactive-class=""
            class="{{ $desktopNavClass($isHome) }}">{{ __('levels.home') }}</a>
          <a href="{{ route('ev.invest.index') }}"
            class="text-emerald-700 font-bold hover:underline">⚡ ebikeGO</a>
          <a href="{{ route('tracking.index') }}"
            class="{{ $desktopNavClass($isTracking) }}">{{ __('levels.track') }}</a>
          <a href="{{ url('/') }}#pricing"
            data-theme-nav-section data-nav-key="pricing"
            data-active-class="{{ $activeNavClasses }}"
            data-inactive-class=""
            class="{{ $desktopNavClass(false) }}">{{ __('levels.pricing') }}</a>
          <a href="{{ url('/') }}#being-merchants"
            data-theme-nav-section data-nav-key="being-merchants"
            data-active-class="{{ $activeNavClasses }}"
            data-inactive-class=""
            class="{{ $desktopNavClass(false) }}">{{ __('levels.merchants') }}</a>
          <a href="{{ route('get.blogs') }}"
            class="{{ $desktopNavClass($isBlog) }}">{{ __('levels.blog') }}</a>
          <a href="{{ route('aboutus.index') }}"
            class="{{ $desktopNavClass($isAbout) }}">{{ __('levels.about') }}</a>
          <a href="{{ route('contact.send.page') }}"
            class="{{ $desktopNavClass($isContact) }}">{{ __('levels.contact') }}</a>

        </nav>

        <div class="flex items-center gap-2 sm:gap-3">
          <div class="hidden sm:block">
            @include('frontend.partials.language-dropdown')
          </div>
          <a href="{{ route('login') }}"
            class="cursor-pointer hidden sm:inline-flex items-center gap-2 rounded-md border border-green-200 bg-green-50/80 px-3 py-2 text-xs font-semibold text-emerald-800 hover:border-emerald-400 hover:bg-green-50 transition-colors duration-300"
            aria-label="{{ __('levels.language') }}">
            {{ __('levels.login') }}
          </a>
          <a href="{{ route('merchant.sign-up') }}"
            class="cursor-pointer hidden sm:inline-flex items-center gap-2 rounded-md border border-green-200 bg-green-50/80 px-3 py-2 text-xs font-semibold text-emerald-800 hover:border-emerald-400 hover:bg-green-50 transition-colors duration-300"
            aria-label="{{ __('levels.language') }}">
            {{ __('levels.register') }}
          </a>
          <button type="button" id="nav-toggle"
            class="xl:hidden inline-flex h-10 w-10 items-center justify-center rounded-lg border border-green-200 text-emerald-800 hover:bg-green-50 transition-colors duration-300"
            aria-expanded="false" aria-controls="mobile-nav">
            <i class="fa-solid fa-bars text-lg" aria-hidden="true"></i>
          </button>
        </div>
      </div>

      <div id="mobile-nav" class="hidden xl:hidden border-t border-border-green-100 py-4 animate-fade-in">
        <nav class="flex flex-col gap-1 text-sm font-semibold text-nav-text">
          <a href="{{ url('/') }}#hero-section"
            data-theme-nav-section data-nav-key="hero-section"
            data-active-class="{{ $activeNavClasses }}"
            data-inactive-class=""
            class="{{ $mobileNavClass($isHome) }}">{{ __('levels.home') }}</a>
          <a href="{{ route('tracking.index') }}"
            class="{{ $mobileNavClass($isTracking) }}">{{ __('levels.track') }}</a>
          <a href="{{ url('/') }}#pricing"
            data-theme-nav-section data-nav-key="pricing"
            data-active-class="{{ $activeNavClasses }}"
            data-inactive-class=""
            class="{{ $mobileNavClass(false) }}">{{ __('levels.pricing') }}</a>
          <a href="{{ url('/') }}#being-merchants"
            data-theme-nav-section data-nav-key="being-merchants"
            data-active-class="{{ $activeNavClasses }}"
            data-inactive-class=""
            class="{{ $mobileNavClass(false) }}">{{ __('levels.merchants') }}</a>
          <a href="{{ route('get.blogs') }}"
            class="{{ $mobileNavClass($isBlog) }}">{{ __('levels.blog') }}</a>
          <a href="{{ route('aboutus.index') }}"
            class="{{ $mobileNavClass($isAbout) }}">{{ __('levels.about') }}</a>
          <a href="{{ route('contact.send.page') }}"
            class="{{ $mobileNavClass($isContact) }}">{{ __('levels.contact') }}</a>
          @include('frontend.partials.language-dropdown')
          <a href="{{ route('login') }}"
            class="rounded-md px-3 py-2.5 hover:bg-nav-bg hover:text-nav-active-text transition-colors duration-300">{{ __('levels.login') }}</a>
          <a href="{{ route('merchant.sign-up') }}"
            class="rounded-md px-3 py-2.5 hover:bg-nav-bg hover:text-nav-active-text transition-colors duration-300">{{ __('levels.register') }}</a>

        </nav>
      </div>
    </div>
  </header>

@once
  @push('scripts')
    <script>
      (function () {
        const homePath = @json(parse_url(route('home'), PHP_URL_PATH) ?: '/');
        const defaultKey = 'hero-section';
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
