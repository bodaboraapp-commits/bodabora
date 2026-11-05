<!-- Newsletter -->
  <section class="bg-newsletter-bg py-16 sm:py-20">
    <div class="container mx-auto max-w-2xl px-4 text-center">
      <h2 class="text-2xl sm:text-3xl font-extrabold text-section-heading-text">{{ __('levels.subscribe_to_newsletter') }}</h2>
      <p class="mt-3 text-section-desc-text text-sm sm:text-base">{{ __('levels.newsletter_intro_alt') }}</p>
      <form
        class="mt-8 flex flex-col sm:flex-row rounded-lg overflow-hidden border border-newsletter-input-border/80 bg-white shadow-sm shadow-emerald-900/5 focus-within:ring-2 focus-within:ring-newsletter-input-focus/25 focus-within:border-newsletter-input-focus-border transition-shadow duration-300"
        action="#" method="post">
        <label class="sr-only" for="newsletter-email">{{ __('levels.email_address') }}</label>
        <input id="newsletter-email" type="email" placeholder="{{ __('levels.enter_your_email') }}"
          class="flex-1 min-w-0 px-4 py-3.5 text-calculate-form-input-text placeholder:text-gray-400 outline-none sm:py-4" />
        <button type="submit"
          class="shrink-0 bg-emerald-600 px-6 py-3.5 text-sm font-semibold text-white hover:bg-emerald-700 transition-colors duration-300 sm:px-8 sm:py-0">
          {{ __('levels.subscribe_now') }}
        </button>
      </form>
    </div>
  </section>
