<!-- Testimonials — side by side -->
  <section class="py-16 bg-white overflow-hidden">
    <div class="container mx-auto px-4">

      <div class="grid lg:grid-cols-12 gap-10 items-start">

        <!-- Left -->
        <div class="lg:col-span-4 py-4">
          <h2 class="text-3xl font-extrabold text-section-heading-text">
            {{ __('levels.latest_blogs') }}
          </h2>

          <div class="mt-6 flex gap-3">
            <button id="prevBtn"
              class="flex h-11 w-11 items-center justify-center rounded-full border border-emerald-200 text-emerald-700 hover:bg-emerald-600 hover:text-white transition-all duration-300">
              <i class="fa-solid fa-chevron-left"></i>
            </button>

            <button id="nextBtn"
              class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-600 text-white hover:bg-emerald-700 transition-all duration-300">
              <i class="fa-solid fa-chevron-right"></i>
            </button>
          </div>
        </div>

        <!-- Slider -->
        <div class="lg:col-span-8 min-w-0">

          <div class="relative overflow-hidden rounded-2xl">

            <div id="testimonialTrack" class="flex transition-transform duration-500 ease-in-out ">

              @foreach ($blogs as $blog)
                @if ($loop->iteration <= 3)
                  <!-- Card -->
                  <div class="min-w-full p-2">
                    <div
                      class="relative rounded-2xl bg-testimo-card-bg p-6 sm:p-8 shadow-xl ring-1 ring-testimo-card-ring h-full">

                      <span class="absolute top-3 right-5 text-7xl font-bold text-testimo-card-icon/20">
                        &ldquo;
                      </span>

                      <blockquote class="relative z-10 text-base sm:text-lg leading-relaxed italic text-testimo-card-text">
                        {{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 150) }}
                      </blockquote>

                      <div class="mt-8 flex items-center gap-4">
                        <img src="{{ $blog->image }}" alt="{{ $blog->title }}"
                          class="h-14 w-14 rounded-full object-cover ring-2 ring-testimo-card-img-ri">

                        <div>
                          <h4 class="font-bold text-testimo-card-cli-name">
                            {{ $blog->title }}
                          </h4>

                          <p class="text-sm text-testimo-card-cli-pos">
                            {{ @$blog->user->name }}
                          </p>
                        </div>
                      </div>

                    </div>
                  </div>
                @endif
              @endforeach

            </div>

          </div>

        </div>

      </div>

    </div>
  </section>
