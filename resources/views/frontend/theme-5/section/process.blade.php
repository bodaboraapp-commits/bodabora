<!-- Process — side by side -->
  <section class="py-20 bg-process-bg/60">
    <div class="container mx-auto px-4">
      <div class="grid gap-10 lg:grid-cols-2 lg:gap-14 items-center">
        <div class="order-2 lg:order-1">
          <img src="{{ static_asset('frontend/theme-5/image/delivery.jpg') }}" alt="Delivery driver in vehicle"
            class="h-[480px] w-full rounded-xl object-cover shadow-xl shadow-emerald-900/10 aspect-[4/3] lg:aspect-[5/4] transition-transform duration-500 hover:scale-[1.01]" />
        </div>
        <div class="order-1 lg:order-2">
          <h2 class="text-2xl sm:text-3xl font-extrabold text-section-heading-text tracking-tight">Process: The Way of
            Works</h2>
          <ol class="mt-8 space-y-4">
            <li
              class="rounded-xl border border-border-green-100 bg-white p-5 shadow-sm transition-shadow duration-300 hover:shadow-md">
              <div class="flex items-start gap-3">
                <span
                  class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-process-step-number-act-bg text-sm font-bold text-white">1</span>
                <div class="min-w-0 flex-1">
                  <h3 class="font-bold text-process-step-heading-text">Drop Sender Location</h3>
                  <p class="mt-2 text-sm leading-relaxed text-process-step-desc-text">
                    Pin your pickup point, choose a time window, and we route the nearest rider to you.
                  </p>
                  <button type="button"
                    class="cursor-pointer mt-3 text-sm font-semibold text-emerald-700 hover:text-emerald-800 transition-colors duration-300">
                    View More <i class="fa-solid fa-arrow-right ml-1 text-xs" aria-hidden="true"></i>
                  </button>
                </div>
              </div>
            </li>
            <li
              class="rounded-xl border border-border-green-100 bg-white/80 p-4 flex items-center gap-3 transition-colors duration-300 hover:bg-white hover:shadow-sm">
              <span
                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-process-step-number-bg text-sm font-bold text-process-step-number-text">2</span>
              <h3 class="font-bold text-process-step-heading-text">Drop Receiver Location</h3>
            </li>
            <li
              class="rounded-xl border border-border-green-100 bg-white/80 p-4 flex items-center gap-3 transition-colors duration-300 hover:bg-white hover:shadow-sm">
              <span
                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-process-step-number-bg text-sm font-bold text-process-step-number-text">3</span>
              <h3 class="font-bold text-process-step-heading-text">Drop Product Details</h3>
            </li>
            <li
              class="rounded-xl border border-border-green-100 bg-white/80 p-4 flex items-center gap-3 transition-colors duration-300 hover:bg-white hover:shadow-sm">
              <span
                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-process-step-number-bg text-sm font-bold text-process-step-number-text">4</span>
              <h3 class="font-bold text-process-step-heading-text">Check &amp; Confirm</h3>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </section>
