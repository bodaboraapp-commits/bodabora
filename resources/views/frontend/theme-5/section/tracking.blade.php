<!-- ================= tracking input box ================= -->
  <section class="-mt-14 relative overflow-hidden">
    <div
      class="mb-12 mx-auto bg-white rounded-3xl shadow-xl p-4 md:p-6 flex flex-col lg:flex-row gap-4 max-w-5xl border border-border-green-100">

      <div class="relative flex-1">

        <i class="fa-solid fa-barcode absolute left-5 top-1/2 -translate-y-1/2 text-tr-input-icon"></i>

        <input type="text" placeholder="{{ __('levels.enter_tracking_id') }}"
          class="w-full h-16 rounded-2xl border border-tr-input-border pl-14 pr-5 outline-none focus:border-tr-input-focus transition-all" />

      </div>

      <button
        class="cursor-pointer h-16 px-8 rounded-2xl bg-button-bg hover:bg-button-hover-bg text-button-text font-semibold transition-all duration-300 hover:scale-105">
        Track Parcel
      </button>

      <button
        class="cursor-pointer h-16 px-8 rounded-2xl border border-button-bg hover:border-button-border-hover text-button-tran-text hover:bg-button-hover-bg hover:text-white font-semibold transition-all duration-300">
        Book Now
      </button>

    </div>
  </section>
