<footer class="bg-footer-bg text-white pt-16 pb-8">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-4 lg:gap-10">
        <div>
          <a href="{{ url('/') }}" class="inline-flex items-center gap-2 group">
            <img src="{{ settings()->light_logo_image }}" alt="{{ settings()->name }}"
              class="rounded-lg group-hover:animate-spin-slow transition-transform"
              style="width: 128px; height: 40px; object-fit: contain;">
          </a>
          <p class="mt-4 text-sm leading-relaxed text-footer-logo-desc/90">
            {!! section(\App\Enums\SectionType::ABOUT,'about_us') !!}
          </p>
          <div class="mt-6 flex gap-3">
            @foreach ($social_links as $social)
              <a href="{{ @$social->link }}"
                class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-footer-icon-border/60 text-footer-icon-text hover:bg-footer-icon-hover-bg hover:border-footer-icon-hover-border transition-all duration-300"
                aria-label="{{ $social->name }}" title="{{ $social->name }}"><i class="{{ $social->icon }}" aria-hidden="true"></i></a>
            @endforeach
          </div>
        </div>
        <div>
          <h3 class="text-sm font-bold uppercase tracking-wider text-footer-link-text-head/90">{{ __('levels.explore') }}</h3>
          <ul class="mt-4 space-y-2.5 text-sm text-footer-link-text/90">
            <li><a href="{{ url('/') }}#hero-section"
                class="hover:text-footer-link-text-hover transition-colors duration-300">{{ __('levels.home') }}</a>
            </li>
            <li><a href="{{ route('get.faq.index') }}" class="hover:text-footer-link-text-hover transition-colors duration-300">{{ __('levels.faq') }}</a>
            </li>
            <li><a href="{{ route('get.blogs') }}" class="hover:text-footer-link-text-hover transition-colors duration-300">{{ __('levels.blog') }}</a>
            </li>
          </ul>
        </div>
        <div>
          <h3 class="text-sm font-bold uppercase tracking-wider text-footer-link-text-head/90">{{ __('levels.company') }}</h3>
          <ul class="mt-4 space-y-2.5 text-sm text-footer-link-text/90">
            <li><a href="{{ route('aboutus.index') }}" class="hover:text-footer-link-text-hover transition-colors duration-300">About
                Us</a></li>
            <li><a href="{{ route('tracking.index') }}"
                class="hover:text-footer-link-text-hover transition-colors duration-300">{{ __('levels.tracking') }}</a></li>
            <li><a href="{{ route('contact.send.page') }}"
                class="hover:text-footer-link-text-hover transition-colors duration-300">{{ __('levels.contact_us') }}</a></li>
            <li><a href="{{ route('privacy.policy.index') }}"
                class="hover:text-footer-link-text-hover transition-colors duration-300">{{ __('levels.privacy_policy') }}</a></li>
            <li><a href="{{ route('termsof.condition.index') }}"
                class="hover:text-footer-link-text-hover transition-colors duration-300">{{ __('levels.terms_and_conditions') }}</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-sm font-bold uppercase tracking-wider text-footer-link-text-head/90">{{ __('levels.quick_contact') }}</h3>
          <form class="mt-4 space-y-3" action="#" method="post">
            <input type="text" name="contact" placeholder="{{ __('levels.email_address_placeholder') }}"
              class="w-full rounded-md border border-footer-input-border/60 bg-footer-input-bg/40 px-3 py-2.5 text-sm text-white placeholder:text-footer-input-placeholder-text/60 outline-none focus:border-footer-input-placeholder-ring focus:ring-1 focus:ring-footer-input-placeholder-ring/40 transition-shadow duration-300" />
            <textarea name="message" rows="3" placeholder="{{ __('levels.enter_your_message') }}"
              class="w-full rounded-md border border-footer-input-border/60 bg-footer-input-bg/40 px-3 py-2.5 text-sm text-white placeholder:text-footer-input-placeholder-text/60 outline-none focus:border-footer-input-placeholder-ring focus:ring-1 focus:ring-footer-input-placeholder-ring/40 transition-shadow duration-300 resize-y min-h-[88px]"></textarea>
            <button type="submit"
              class="w-full rounded-md bg-emerald-600 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500 transition-colors duration-300">
              Send Message
            </button>
          </form>
        </div>
      </div>
      <div
        class="mt-14 border-t border-footer-copy-border/80 pt-8 text-center text-xs sm:text-sm text-footer-copy-text/80">
        {{ settings()->copyright }}
      </div>
    </div>
  </footer>
