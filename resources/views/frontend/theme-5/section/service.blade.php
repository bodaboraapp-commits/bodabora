<!-- Services -->

  <section class="py-24">
    <div class="container mx-auto px-4">

      <!-- Section Heading -->
      <div class="text-center max-w-2xl mx-auto mb-14">
        <h2 class="mt-4 text-4xl md:text-5xl font-bold text-section-heading-text">
          {{ __('levels.our_services') }}
        </h2>
        <p class="mt-5 text-section-desc-text leading-8">
          {{ __('levels.service_section_intro') }}
        </p>
      </div>

      <!-- Grid -->
      <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        @foreach ($services as $service)
          @if ($loop->iteration <= 4)
            <div
              class="group bg-white border border-border-green-100 rounded-xl p-6 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">

              <div
                class="w-12 h-12 flex items-center justify-center rounded-lg bg-pricing-icon-bg text-pricing-icon-text py-2">
                <img src="{{ $service->image }}" alt="{{ $service->title }}" class="w-10 h-10 object-contain" />
              </div>

              <h3 class="mt-5 text-lg font-semibold text-section-heading-text">
                {{ $service->title }}
              </h3>

              <p class="mt-2 text-sm text-section-desc-text">
                {{ \Illuminate\Support\Str::limit(strip_tags($service->description ?? ''), 110) }}
              </p>

              <a href="{{ route('service.details', $service->id) }}"
                class="mt-5 inline-flex items-center gap-2 text-section-text font-medium group-hover:text-button-hover-bg">
                {{ __('levels.learn_more') }}
                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor"
                  stroke-width="2" viewBox="0 0 24 24">
                  <path d="M9 5l7 7-7 7" />
                </svg>
              </a>
            </div>
          @endif
        @endforeach

      </div>
    </div>
  </section>
