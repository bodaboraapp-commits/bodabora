@extends(active_theme() . '.layouts.master')
@section('title')
    {{ __("levels.parcel_tracking") }} | {{ settings()->name }}
@endsection
@section('content')
@php
    $trackingId = $request->tracking_id;
    $latestLog = $parcelevents->first();
@endphp
<section class="relative overflow-hidden pt-12 pb-10 sm:pt-16 sm:pb-14">
        <div class="absolute -top-20 -left-16 w-72 h-72 bg-hero-bg-overlay-one rounded-full blur-3xl opacity-70"></div>
        <div class="absolute -bottom-20 -right-10 w-80 h-80 bg-hero-bg-overlay-two rounded-full blur-3xl opacity-45">
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="lg:col-span-7">
                <span
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-badge-bg text-badge-text text-xs sm:text-sm font-semibold">
                    {{ __('levels.live_parcel_tracking') }}
                </span>
                <h2 class="mt-6 text-3xl sm:text-4xl lg:text-5xl font-black leading-tight text-section-deep-text">
                    {{ __('levels.track_shipment_in') }} <span class="text-section-text">{{ __('levels.real_time') }}</span>
                </h2>
                <p class="mt-5 text-section-light-text text-base sm:text-lg leading-8 max-w-2xl mx-auto">
                    {{ __('levels.tracking_dashboard_intro') }}
                </p>

                <div
                    class="mx-auto max-w-4xl mt-8 bg-white rounded-2xl border border-border-green-100 shadow-lg p-4 sm:p-5 card-hover">
                    <form action="{{ route('tracking.index') }}" method="GET">
                        <label for="tracking-id" class="text-sm font-semibold text-section-desc-text">{{ __('levels.tracking_number') }}</label>
                        <div class="mt-3 flex flex-col sm:flex-row gap-3">
                            <input id="tracking-id" type="text" name="tracking_id" value="{{ $trackingId }}"
                                class="w-full h-12 px-4 rounded-xl border border-contact-input-border outline-none focus:border-contact-input-focus focus:ring-2 focus:ring-green-100 transition"
                                placeholder="{{ __('levels.enter_tracking_id') }}">
                            <button type="submit"
                                class="cursor-pointer text-nowrap h-12 px-6 rounded-xl gradient-btn font-semibold hover:scale-[1.02] transition-all duration-300 shadow-md shadow-green-200">
                                {{ __('levels.track_now') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <main class="pb-16 sm:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 sm:space-y-10">
            @if(!empty($trackingId) && !$parcel)
                <div class="bg-white rounded-3xl border border-border-green-100 shadow-lg p-8 text-center">
                    <img src="{{ static_asset('frontend/images/parcel-was-not-found.png') }}" class="mx-auto max-w-md w-full" />
                </div>
            @endif

            @if(!empty($trackingId) && $parcel)
            <section class="grid xl:grid-cols-12 gap-8">
                <div class="xl:col-span-8 bg-white rounded-3xl border border-border-green-100 shadow-lg p-5 sm:p-8">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <h3 class="text-2xl sm:text-3xl font-black text-section-deep-text">{{ __('levels.shipment_timeline') }}</h3>
                            <p class="mt-2 text-section-light-text">{{ __('levels.tracking_id_label') }}: <span
                                    class="font-semibold text-section-desc-text">{{ $parcel->tracking_id }}</span></p>
                        </div>
                        <span class="px-4 py-2 rounded-full bg-badge-bg text-badge-text text-sm font-semibold">{{ __('parcelStatus.'.$parcel->status) }}</span>
                    </div>

                    <div class="mt-8 space-y-6">
                        @foreach ($parcelevents as $log)
                            <div class="flex gap-4 sm:gap-5">
                                <div class="flex flex-col items-center">
                                    <span class="{{ $loop->first ? 'w-4 h-4 rounded-full bg-emerald-500 ring-4 ring-emerald-100 pulse-dot' : 'w-4 h-4 rounded-full bg-green-600 ring-4 ring-green-100' }}"></span>
                                    @if (!$loop->last)
                                        <span class="mt-2 w-0.5 h-16 bg-green-200"></span>
                                    @endif
                                </div>
                                <div class="flex-1 pb-2">
                                    <p class="text-sm text-section-extra-light-text">{!! dateFormat($log->created_at) !!}, {!! date('h:i A', strtotime($log->created_at)) !!}</p>
                                    <h4 class="mt-1 font-extrabold text-lg text-section-deep-text">{{ __('parcelLogs.'.$log->parcel_status) }}</h4>
                                    <p class="mt-1 text-section-light-text leading-7">{{ $log->note }}</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex gap-4 sm:gap-5">
                            <div class="flex flex-col items-center">
                                <span class="w-4 h-4 rounded-full bg-green-600 ring-4 ring-green-100"></span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-section-extra-light-text">{!! dateFormat($parcel->created_at) !!}, {!! date('h:i A', strtotime($parcel->created_at)) !!}</p>
                                <h4 class="mt-1 font-extrabold text-lg text-section-deep-text">{{ __('parcel.parcel_create') }}</h4>
                                <p class="mt-1 text-section-light-text leading-7">{{ __('levels.name') }}: {{ @$parcel->merchant->user->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="xl:col-span-4 space-y-6">
                    <div class="bg-white rounded-3xl border border-border-green-100 shadow-lg p-5 sm:p-6 card-hover">
                        <h4 class="text-xl font-black text-section-deep-text">{{ __('levels.sender_receiver') }}</h4>
                        <div class="mt-5 space-y-4 text-sm">
                            <div class="gradient-soft rounded-2xl p-4">
                                <p class="text-section-extra-light-text uppercase tracking-wide text-xs">{{ __('levels.from') }}</p>
                                <p class="mt-1 font-bold text-section-deep-text">{{ @$parcel->merchant->user->name }}</p>
                                <p class="mt-1 text-section-light-text">{{ @$parcel->pickup_address }}</p>
                            </div>
                            <div class="gradient-soft rounded-2xl p-4">
                                <p class="text-section-extra-light-text uppercase tracking-wide text-xs">{{ __('levels.to') }}</p>
                                <p class="mt-1 font-bold text-section-deep-text">{{ @$parcel->customer_name }}</p>
                                <p class="mt-1 text-section-light-text">{{ @$parcel->customer_address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl border border-border-green-100 shadow-lg p-5 sm:p-6 card-hover">
                        <h4 class="text-xl font-black text-section-deep-text">{{ __('levels.package_details') }}</h4>
                        <ul class="mt-4 space-y-3 text-sm text-section-desc-text">
                            <li class="flex items-center justify-between gap-3"><span>{{ __('levels.service_type') }}</span><span
                                    class="font-semibold text-section-deep-text">{{ @$parcel->delivery_type_name }}</span></li>
                            <li class="flex items-center justify-between gap-3"><span>{{ __('levels.weight') }}</span><span
                                    class="font-semibold text-section-deep-text">{{ @$parcel->weight }} {{ @$parcel->deliveryCategory->title }}</span></li>
                            <li class="flex items-center justify-between gap-3"><span>{{ __('levels.pieces') }}</span><span
                                    class="font-semibold text-section-deep-text">{{ __('levels.one_parcel') }}</span></li>
                            <li class="flex items-center justify-between gap-3"><span>{{ __('levels.payment') }}</span><span
                                    class="font-semibold text-section-deep-text">{{ __('levels.cash_on_delivery') }}</span></li>
                            <li class="flex items-center justify-between gap-3"><span>{{ __('levels.amount') }}</span><span
                                    class="font-semibold text-section-text">{{ @$parcel->cash_collection }}</span></li>
                        </ul>
                    </div>
                </aside>
            </section>

            @endif
        </div>
    </main>
    <!-- ========================================= -->
    <!-- FOOTER -->
    <!-- ========================================= -->
@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@endsection
