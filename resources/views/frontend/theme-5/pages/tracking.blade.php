@extends(active_theme() . '.layouts.master')
@section('title')
    {{ __('levels.parcel_tracking') }} | {{ @settings()->name }}
@endsection
@section('content')
@php
    $trackingId = $request->tracking_id;
    $latestLog = $parcelevents->first();
    $completedMilestones = $parcel ? min($parcelevents->count() + 1, 6) : 0;
    $progressWidth = $parcel ? min($completedMilestones * 16, 100) : 0;
@endphp
<main class="flex-1">
    <!-- Page intro -->
    <section
      class="border-b border-border-green-100 bg-gradient-to-br from-intro-gr-from via-intro-gr-via to-intro-gr-to text-white">
      <div class="container mx-auto px-4 py-10 sm:py-12">
        <nav class="text-xs sm:text-sm text-intro-nav-text/90" aria-label="{{ __('levels.breadcrumb') }}">
          <ol class="flex flex-wrap items-center gap-2">
            <li><a href="{{ url('/') }}" class="hover:text-white transition-colors duration-300">{{ __('levels.home') }}</a></li>
            <li aria-hidden="true"><i class="fa-solid fa-chevron-right text-[10px] opacity-60"></i></li>
            <li class="font-medium text-white">{{ __('levels.track_parcel') }}</li>
          </ol>
        </nav>
        <h1 class="mt-4 text-2xl sm:text-3xl font-extrabold tracking-tight">{{ __('levels.shipment_tracking') }}</h1>
        <p class="mt-2 max-w-2xl text-sm sm:text-base text-intro-desc-text/95">{{ __('levels.shipment_tracking_intro') }}</p>

        <form
          class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-stretch max-w-3xl rounded-xl bg-white/10 p-3 sm:p-2 ring-1 ring-white/20 backdrop-blur-sm"
          action="{{ route('tracking.index') }}" method="get" role="search">
          <label class="sr-only" for="q">{{ __('levels.tracking_or_reference_id') }}</label>
          <input id="q" name="tracking_id" type="text" value="{{ $trackingId }}" placeholder="{{ __('levels.enter_tracking_id') }}"
            class="flex-1 min-w-0 rounded-lg border border-white/25 bg-white/95 px-4 py-3 text-section-deep-text placeholder:text-section-light-text outline-none focus:ring-2 focus:ring-emerald-200/80 transition-shadow duration-300" />
          <button type="submit"
            class="cursor-pointer shrink-0 rounded-lg bg-intro-btn-bg px-6 py-3 text-sm font-semibold text-intro-btn-text shadow-md hover:bg-intro-btn-hover-bg transition-colors duration-300 sm:py-0">
            {{ __('levels.track_again') }}
          </button>
        </form>
      </div>
    </section>

    <div class="container mx-auto px-4 py-10 sm:py-14">
      @if(!empty($trackingId) && !$parcel)
        <div class="rounded-2xl border border-border-green-100 bg-white p-5 sm:p-6 shadow-lg shadow-emerald-900/5 animate-fade-in text-center">
          <img src="{{ static_asset('frontend/images/parcel-was-not-found.png') }}" class="mx-auto max-w-md w-full" />
        </div>
      @endif

      @if(!empty($trackingId) && $parcel)
      <!-- Summary strip -->
      <div
        class="rounded-2xl border border-border-green-100 bg-white p-5 sm:p-6 shadow-lg shadow-emerald-900/5 animate-fade-in">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
          <div class="min-w-0 flex-1">
            <div class="flex flex-wrap items-center gap-2">
              <span
                class="inline-flex items-center gap-1.5 rounded-full bg-summary-badge-bg px-3 py-1 text-xs font-bold uppercase tracking-wide text-summary-badge-text">
                <span class="relative flex h-2 w-2">
                  <span
                    class="absolute inline-flex h-full w-full animate-ping rounded-full bg-summary-badge-ping-an-bg opacity-75"></span>
                  <span class="relative inline-flex h-2 w-2 rounded-full bg-summary-badge-ping-bg"></span>
                </span>
                {{ __('parcelStatus.'.$parcel->status) }}
              </span>
              <span class="text-xs font-semibold text-section-light-text">{{ __('levels.last_update') }}: {{ $latestLog ? dateFormat($latestLog->created_at).' · '.date('h:i A', strtotime($latestLog->created_at)) : dateFormat($parcel->created_at).' · '.date('h:i A', strtotime($parcel->created_at)) }}</span>
            </div>
            <p class="mt-3 font-mono text-lg sm:text-xl font-bold text-section-heading-text tracking-tight break-all">
              {{ $parcel->tracking_id }}</p>
            <p class="mt-1 text-sm text-section-desc-text">{{ __('levels.merchant_ref') }}: <span
                class="font-medium text-section-deep-text">{{ @$parcel->invoice_no ?? 'N/A' }}</span> · {{ __('levels.cod_collection_authorized') }}</p>
          </div>
          <div class="w-full shrink-0 lg:w-auto lg:text-right">
            <p class="text-xs font-semibold uppercase tracking-wide text-section-text">{{ __('levels.estimated_delivery') }}</p>
            <p class="mt-1 text-lg font-extrabold text-section-heading-text">{{ @$parcel->delivery_date ? dateFormat($parcel->delivery_date) : 'N/A' }}</p>
            <p class="text-sm text-section-desc-text">{{ __('levels.recipient_zone') }}: {{ @$parcel->customer_address }}</p>
            <div class="mt-4 flex flex-wrap gap-2 lg:justify-end">
              <button type="button"
                class="inline-flex items-center justify-center gap-2 rounded-lg border border-green-200 bg-green-50 px-4 py-2 text-sm font-semibold text-emerald-800 hover:border-emerald-400 transition-colors duration-300">
                <i class="fa-solid fa-file-arrow-down" aria-hidden="true"></i>
                {{ __('levels.label_pdf') }}
              </button>
              <button type="button"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-emerald-600/25 hover:bg-emerald-700 transition-colors duration-300">
                <i class="fa-solid fa-share-nodes" aria-hidden="true"></i>
                {{ __('levels.share_status') }}
              </button>
            </div>
          </div>
        </div>

        <!-- Progress bar -->
        <div class="mt-6 sm:mt-8">
          <div class="flex justify-between text-xs font-semibold text-gray-500 mb-2">
            <span>{{ __('levels.booked') }}</span>
            <span class="text-section-text">{{ __('levels.in_progress') }}</span>
            <span>{{ __('levels.delivered_stat') }}</span>
          </div>
          <div class="h-2.5 w-full overflow-hidden rounded-full bg-progress-bg">
            <div
              class="h-full rounded-full bg-gradient-to-r from-progress-gr-bg-from to-progress-gr-bg-to transition-all duration-500" style="width: {{ $progressWidth }}%">
            </div>
          </div>
          <p class="mt-2 text-xs text-section-light-text">{{ __('levels.milestones_completed', ['completed' => $completedMilestones, 'total' => 6]) }} · {{ __('levels.next') }}: <span
              class="font-medium text-progress-text">{{ $latestLog ? __('parcelLogs.'.$latestLog->parcel_status) : __('parcel.parcel_create') }}</span></p>
        </div>
      </div>

      <div class="mt-8 grid gap-8 lg:grid-cols-12 lg:gap-10">
        <!-- Left column: details + timeline -->
        <div class="lg:col-span-7 space-y-8">
          <section
            class="rounded-2xl border border-section-tracking-border bg-white p-5 sm:p-6 shadow-md shadow-emerald-900/5">
            <h2 class="text-lg font-extrabold text-section-heading-text">{{ __('levels.shipment_facts') }}</h2>
            <dl class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
              <div class="rounded-lg border border-section-grid-border bg-section-grid-bg/50 p-4">
                <dt class="text-xs font-semibold uppercase tracking-wide text-section-grid-title">{{ __('levels.service') }}</dt>
                <dd class="mt-1 font-semibold text-section-grid-text">{{ @$parcel->delivery_type_name }}</dd>
              </div>
              <div class="rounded-lg border border-section-grid-border bg-section-grid-bg/50 p-4">
                <dt class="text-xs font-semibold uppercase tracking-wide text-section-grid-title">{{ __('levels.payment') }}</dt>
                <dd class="mt-1 font-semibold text-section-grid-text">{{ __('levels.cod') }} — <span class="text-section-grid-heil-text">{{ @$parcel->cash_collection }}</span></dd>
              </div>
              <div class="rounded-lg border border-section-grid-border bg-section-grid-bg/50 p-4">
                <dt class="text-xs font-semibold uppercase tracking-wide text-section-grid-title">{{ __('levels.weight_size') }}</dt>
                <dd class="mt-1 font-semibold text-section-grid-text">{{ @$parcel->weight }} {{ @$parcel->deliveryCategory->title }}</dd>
              </div>
              <div class="rounded-lg border border-section-grid-border bg-section-grid-bg/50 p-4">
                <dt class="text-xs font-semibold uppercase tracking-wide text-section-grid-title">{{ __('levels.pieces_type') }}</dt>
                <dd class="mt-1 font-semibold text-section-grid-text">{{ __('levels.one_parcel') }} · {{ @$parcel->deliveryCategory->title }}</dd>
              </div>
              <div class="rounded-lg border border-section-grid-border bg-section-grid-bg/50 p-4 sm:col-span-2">
                <dt class="text-xs font-semibold uppercase tracking-wide text-section-grid-title">{{ __('levels.booked_on') }}</dt>
                <dd class="mt-1 font-semibold text-section-grid-text">{{ dateFormat($parcel->created_at) }} · {{ date('h:i A', strtotime($parcel->created_at)) }}</dd>
              </div>
            </dl>
          </section>

          <section
            class="rounded-2xl border border-section-tracking-border bg-white p-5 sm:p-6 shadow-md shadow-emerald-900/5">
            <h2 class="text-lg font-extrabold text-section-heading-text">{{ __('levels.sender_receiver') }}</h2>
            <div class="mt-5 grid gap-5 sm:grid-cols-2">
              <div
                class="rounded-xl border border-section-grid-border p-4 transition-shadow duration-300 hover:shadow-md">
                <p class="text-xs font-bold uppercase tracking-wide text-section-grid-title">{{ __('levels.from') }}</p>
                <p class="mt-2 font-semibold text-section-grid-text">{{ @$parcel->merchant->user->name }}</p>
                <p class="mt-1 text-sm text-section-light-text leading-relaxed">{{ @$parcel->pickup_address }}
                </p>
                <p class="mt-3 text-sm"><span class="text-section-light-text">{{ __('levels.contact_label') }}:</span> <span
                    class="font-medium">{{ @$parcel->pickup_phone }}</span></p>
              </div>
              <div
                class="rounded-xl border border-section-grid-border p-4 transition-shadow duration-300 hover:shadow-md">
                <p class="text-xs font-bold uppercase tracking-wide text-section-grid-title">{{ __('levels.to') }}</p>
                <p class="mt-2 font-semibold text-section-grid-text">{{ @$parcel->customer_name }}</p>
                <p class="mt-1 text-sm text-section-light-text leading-relaxed">{{ @$parcel->customer_address }}</p>
                <p class="mt-3 text-sm"><span class="text-section-light-text">{{ __('levels.phone_label') }}:</span> <span
                    class="font-medium">{{ @$parcel->customer_phone }}</span></p>
              </div>
            </div>
          </section>

          <section
            class="rounded-2xl border border-section-tracking-border bg-white p-5 sm:p-6 shadow-md shadow-emerald-900/5">
            <h2 class="text-lg font-extrabold text-section-heading-text">{{ __('levels.package_contents') }}</h2>
            <ul class="mt-4 divide-y divide-section-grid-border text-sm">
              <li class="flex flex-wrap justify-between gap-2 py-3 first:pt-0">
                <span class="text-section-light-text">{{ __('levels.declared_description') }}</span>
                <span class="font-medium text-section-grid-text text-right">{{ @$parcel->note ?? 'N/A' }}</span>
              </li>
              <li class="flex flex-wrap justify-between gap-2 py-3">
                <span class="text-section-light-text">{{ __('levels.declared_value') }}</span>
                <span class="font-medium text-section-grid-text">{{ @$parcel->selling_price ?? 'N/A' }}</span>
              </li>
              <li class="flex flex-wrap justify-between gap-2 py-3">
                <span class="text-section-light-text">{{ __('levels.insurance') }}</span>
                <span class="font-medium text-section-grid-title">{{ @$parcel->packaging ? @$parcel->packaging->name : 'N/A' }}</span>
              </li>
              <li class="flex flex-wrap justify-between gap-2 py-3">
                <span class="text-section-light-text">{{ __('levels.special_instructions') }}</span>
                <span class="font-medium text-section-grid-text text-right max-w-[16rem]">{{ @$parcel->note ?? 'N/A' }}</span>
              </li>
            </ul>
          </section>

          <section
            class="rounded-2xl border border-section-tracking-border bg-white p-5 sm:p-6 shadow-md shadow-emerald-900/5">
            <div class="flex flex-wrap items-end justify-between gap-3">
              <h2 class="text-lg font-extrabold text-section-heading-text">{{ __('levels.activity_timeline') }}</h2>
              <button type="button"
                class="cursor-pointer text-sm font-semibold text-section-grid-title hover:text-emerald-900 transition-colors duration-300">{{ __('levels.download_log') }}</button>
            </div>
            <ol class="mt-6 relative border-l-2 border-section-tracking-border pl-6 space-y-8 ml-2">
              @foreach ($parcelevents as $log)
                <li class="relative">
                  <span
                    class="absolute -left-[2.2rem] top-1 flex h-6 w-6 items-center justify-center rounded-full {{ $loop->first ? 'bg-section-prog-icon-active-bg text-section-prog-icon-active-text' : 'bg-section-prog-icon-bg text-section-prog-icon-text' }} ring-4 ring-section-prog-icon-ring">
                    <i class="fa-solid fa-truck text-[10px]" aria-hidden="true"></i>
                  </span>
                  <p class="text-sm font-bold {{ $loop->first ? 'text-gray-900' : 'text-section-prog-title' }}">{{ __('parcelLogs.'.$log->parcel_status) }}</p>
                  <p class="text-xs {{ $loop->first ? 'text-section-prog-date-active font-semibold' : 'text-section-prog-date font-medium' }} mt-0.5">{{ dateFormat($log->created_at) }} · {{ date('h:i A', strtotime($log->created_at)) }}</p>
                  <p class="mt-1 text-sm text-section-prog-desc">{{ $log->note }}</p>
                </li>
              @endforeach
              <li class="relative">
                <span
                  class="absolute -left-[2.2rem] top-1 flex h-6 w-6 items-center justify-center rounded-full bg-section-prog-icon-bg text-section-prog-icon-text ring-4 ring-section-prog-icon-ring">
                  <i class="fa-solid fa-box text-[10px]" aria-hidden="true"></i>
                </span>
                <p class="text-sm font-bold text-section-prog-title">{{ __('parcel.parcel_create') }}</p>
                <p class="text-xs text-section-prog-date font-medium mt-0.5">{{ dateFormat($parcel->created_at) }} · {{ date('h:i A', strtotime($parcel->created_at)) }}</p>
                <p class="mt-1 text-sm text-section-prog-desc">{{ __('levels.name') }}: {{ @$parcel->merchant->user->name }}</p>
              </li>
              <li class="relative opacity-60">
                <span
                  class="absolute -left-[2.2rem] top-1 flex h-6 w-6 items-center justify-center rounded-full border-2 border-dashed border-section-inc-prog-border bg-section-inc-prog-bg text-section-inc-prog-text ring-4 ring-section-inc-prog-ring">
                  <i class="fa-solid fa-house-chimney text-[10px]" aria-hidden="true"></i>
                </span>
                <p class="text-sm font-bold text-section-inc-prog-title">{{ __('levels.delivered_stat') }}</p>
                <p class="text-xs text-section-inc-prog-date font-medium mt-0.5">{{ in_array($parcel->status, [\App\Enums\ParcelStatus::DELIVERED, \App\Enums\ParcelStatus::PARTIAL_DELIVERED]) ? __('parcelStatus.'.$parcel->status) : __('levels.pending') }}</p>
                <p class="mt-1 text-sm text-section-inc-prog-desc">{{ __('levels.proof_delivery_pending_text') }}</p>
              </li>
            </ol>
          </section>
        </div>

        <!-- Right column: map + courier + POD -->
        <div class="lg:col-span-5 space-y-8">

          <section
            class="rounded-2xl border border-section-tracking-border bg-white p-5 sm:p-6 shadow-md shadow-emerald-900/5">
            <h2 class="text-lg font-extrabold text-section-heading-text">{{ __('levels.assigned_courier') }}</h2>
            <div class="mt-4 flex gap-4">
              <img src="https://randomuser.me/api/portraits/men/32.jpg" alt=""
                class="h-16 w-16 rounded-xl object-cover ring-2 ring-section-cur-img-ring shadow-sm" width="64"
                height="64" />
              <div class="min-w-0 flex-1">
                <p class="font-bold text-section-deep-text">{{ @$latestLog->deliveryMan->user->name ?? @$latestLog->pickupman->user->name ?? 'N/A' }}</p>
                <p class="text-sm text-section-desc-text">{{ @$latestLog->deliveryMan->user->mobile ?? @$latestLog->pickupman->user->mobile ?? 'N/A' }}</p>
                <div class="mt-3 flex flex-wrap gap-2">
                  <a href="tel:"
                    class="inline-flex items-center gap-2 rounded-lg bg-emerald-600 px-3 py-2 text-xs font-semibold text-white hover:bg-emerald-700 transition-colors duration-300">
                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                    {{ __('levels.call_courier') }}
                  </a>
                  <button type="button"
                    class="cursor-pointer inline-flex items-center gap-2 rounded-lg border border-green-200 bg-green-50 px-3 py-2 text-xs font-semibold text-emerald-800 hover:border-emerald-400 transition-colors duration-300">
                    <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                    WhatsApp
                  </button>
                </div>
              </div>
            </div>
          </section>

          <section class="rounded-2xl border border-dashed border-section-pod-border bg-section-pod-bg/60 p-5 sm:p-6">
            <h2 class="text-lg font-extrabold text-section-heading-text">{{ __('levels.proof_of_delivery') }}</h2>
            <p class="mt-2 text-sm text-section-desc-text">{{ __('levels.pod_pending_detail') }}</p>
            <div
              class="mt-4 rounded-xl border border-section-pod-file-bg bg-white/80 p-6 text-center text-sm text-section-pod-file-text">
              <i class="fa-regular fa-image text-2xl text-section-pod-file-icon mb-2 block" aria-hidden="true"></i>
              {{ __('levels.no_pod_yet') }}
            </div>
          </section>

        </div>
      </div>
      @endif
    </div>
  </main>
@push('scripts')
<script>
    (function () {
      var toggle = document.getElementById("nav-toggle");
      var panel = document.getElementById("mobile-nav");
      if (!toggle || !panel) return;
      toggle.addEventListener("click", function () {
        var open = panel.classList.toggle("hidden") === false;
        toggle.setAttribute("aria-expanded", open ? "true" : "false");
      });
    })();
  </script>
@endpush

@endsection
