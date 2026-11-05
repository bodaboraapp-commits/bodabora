@extends(active_theme() . '.layouts.master')
@section('title')
    {{ __('levels.parcel_tracking') }} | {{ @settings()->name }}
@endsection
@section('content')
@php
    $trackingId = $request->tracking_id;
    $currentStep = 1;
    $latestLog = $parcelevents->first();

    if ($parcel) {
        if (in_array($parcel->status, [\App\Enums\ParcelStatus::RECEIVED_BY_PICKUP_MAN, \App\Enums\ParcelStatus::RECEIVED_WAREHOUSE, \App\Enums\ParcelStatus::TRANSFER_TO_HUB, \App\Enums\ParcelStatus::RECEIVED_BY_HUB])) {
            $currentStep = 2;
        } elseif (in_array($parcel->status, [\App\Enums\ParcelStatus::DELIVERY_MAN_ASSIGN, \App\Enums\ParcelStatus::DELIVERY_RE_SCHEDULE, \App\Enums\ParcelStatus::DELIVER, \App\Enums\ParcelStatus::RETURN_TO_COURIER, \App\Enums\ParcelStatus::RETURN_ASSIGN_TO_MERCHANT, \App\Enums\ParcelStatus::RETURN_MERCHANT_RE_SCHEDULE])) {
            $currentStep = 3;
        } elseif (in_array($parcel->status, [\App\Enums\ParcelStatus::DELIVERED, \App\Enums\ParcelStatus::PARTIAL_DELIVERED])) {
            $currentStep = 4;
        }
    }

    $progressPercentages = [1 => '0%', 2 => '26%', 3 => '51%', 4 => '77%'];
    $statusBadgeClass = $currentStep === 4 ? 'bg-gray-100 text-gray-700 border border-gray-200' : ($currentStep === 3 ? 'bg-brand-100 text-brand-800 border border-brand-200' : ($currentStep === 2 ? 'bg-orange-100 text-orange-800 border border-orange-200' : 'bg-blue-100 text-blue-800 border border-blue-200'));
    $statusIndicatorClass = $currentStep === 4 ? 'bg-gray-500' : ($currentStep === 3 ? 'bg-brand-500 status-badge-pulse' : ($currentStep === 2 ? 'bg-orange-500 animate-pulse' : 'bg-blue-500'));
    $steps = [
        1 => ['title' => __('levels.order_processed'), 'icon' => 'fas fa-clipboard-check', 'time' => $parcel ? dateFormat($parcel->created_at) : '--', 'desc' => __('levels.sender_created_shipment')],
        2 => ['title' => __('levels.in_transit'), 'icon' => 'fas fa-truck-fast', 'time' => optional($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::RECEIVED_WAREHOUSE))->created_at ? dateFormat($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::RECEIVED_WAREHOUSE)->created_at) : '--', 'desc' => __('levels.package_moving_network')],
        3 => ['title' => __('levels.out_for_delivery'), 'icon' => 'fas fa-map-location-dot', 'time' => optional($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::DELIVERY_MAN_ASSIGN))->created_at ? dateFormat($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::DELIVERY_MAN_ASSIGN)->created_at) : '--', 'desc' => __('levels.courier_on_way')],
        4 => ['title' => __('levels.delivered'), 'icon' => 'fas fa-house-circle-check', 'time' => optional($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::DELIVERED))->created_at ? dateFormat($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::DELIVERED)->created_at) : '--', 'desc' => __('levels.package_successfully_delivered')],
    ];
@endphp
<!-- Main Content -->
    <main class="flex-grow py-12 px-6">
        <div class="container mx-auto max-w-4xl">

            <!-- Search Section -->
            <div class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-brand-100 mb-8">
                <h1 class="text-2xl font-extrabold text-brand-900 mb-2">{{ __('levels.parcel_tracking') }}</h1>
                <p class="text-gray-500 text-sm mb-6">{{ __('levels.enter_tracking_id') }}
                </p>

                <form action="{{ route('tracking.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-barcode text-brand-400"></i>
                        </div>
                        <input type="text" name="tracking_id" value="{{ $trackingId }}" placeholder="{{ __('levels.enter_tracking_id') }}" required
                            class="block w-full pl-11 pr-4 py-3.5 border-2 border-gray-200 rounded-2xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-0 focus:border-brand-600 transition-colors bg-gray-50 font-medium uppercase">
                    </div>
                    <button type="submit"
                        class="bg-brand-600 hover:bg-brand-800 text-white px-8 py-3.5 rounded-2xl font-bold transition-colors shadow-md flex items-center justify-center gap-2 whitespace-nowrap">
                        {{ __('levels.track_now') }} <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Tracking Result Container (Hidden by default) -->
            <div id="resultContainer" class="{{ empty($trackingId) ? 'hidden' : '' }} space-y-8 animate-fade-in">

                <!-- Invalid State Card -->
                <div id="invalidState"
                    class="{{ empty($trackingId) || $parcel ? 'hidden' : '' }} bg-red-50 border-2 border-red-100 rounded-3xl p-8 text-center shadow-sm">
                    <div
                        class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-red-900 mb-2">{{ __('levels.tracking_id_not_found') }}</h2>
                    <p class="text-red-700">{{ __('levels.tracking_not_found_message', ['id' => $trackingId]) }}</p>
                </div>

                <!-- Valid State Content -->
                <div id="validState" class="{{ !$parcel ? 'hidden' : '' }} space-y-8">
                    <!-- Status Header Card -->
                    <div
                        class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-brand-100 flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
                        <!-- BG Decoration -->
                        <div class="absolute -right-10 -bottom-10 opacity-5">
                            <i class="fas fa-box-open text-9xl"></i>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 font-medium mb-1">{{ __('levels.tracking_id_label') }}</p>
                            <h2 id="trackingIdDisplay" class="text-3xl font-extrabold text-brand-900 tracking-wider">
                                {{ @$parcel->tracking_id }}</h2>
                        </div>
                        <div class="text-left md:text-right">
                            <p class="text-sm text-gray-500 font-medium mb-2">{{ __('levels.current_status') }}</p>
                            <div id="statusBadge"
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full font-bold text-sm {{ $statusBadgeClass }}">
                                <span id="statusIndicator" class="w-2.5 h-2.5 rounded-full {{ $statusIndicatorClass }}"></span>
                                <span id="statusText">{{ $parcel ? __('parcelStatus.'.$parcel->status) : '' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Timeline Card -->
                    <div class="bg-white rounded-3xl p-6 md:p-10 shadow-soft border border-brand-100">
                        <h3 class="text-xl font-bold text-brand-900 mb-8 md:mb-12">{{ __('levels.shipment_progress') }}</h3>

                        <!-- Desktop Horizontal Timeline -->
                        <div class="hidden md:block relative">
                            <!-- Background Track -->
                            <div class="absolute top-6 left-[10%] right-[10%] h-1.5 bg-gray-100 rounded-full"></div>
                            <!-- Active Progress Track -->
                            <div id="progressTrackDesktop"
                                class="absolute top-6 left-[10%] h-1.5 bg-brand-500 rounded-full progress-line"
                                style="width: {{ $progressPercentages[$currentStep] }};"></div>

                            <div class="grid grid-cols-4 gap-4 text-center relative z-10">
                                @foreach ($steps as $stepNumber => $step)
                                    @php
                                        $isCompleted = $stepNumber < $currentStep;
                                        $isCurrent = $stepNumber === $currentStep;
                                        $iconClass = $isCompleted ? 'border-brand-500 bg-brand-500 text-white' : ($isCurrent ? 'border-brand-500 bg-brand-50 text-brand-600 shadow-glow icon-bounce' : 'bg-white border-gray-200 text-gray-400');
                                        $titleClass = $stepNumber <= $currentStep ? 'text-brand-900' : 'text-gray-400';
                                        $timeClass = $stepNumber <= $currentStep ? 'text-gray-500' : 'text-gray-400';
                                    @endphp
                                    <div class="timeline-step group" data-step="{{ $stepNumber }}">
                                        <div
                                            class="step-icon w-12 h-12 mx-auto border-4 rounded-full flex items-center justify-center mb-4 transition-all duration-500 relative z-10 {{ $iconClass }}">
                                            <i class="{{ $step['icon'] }}"></i>
                                        </div>
                                        <h4 class="font-bold step-title transition-colors duration-500 {{ $titleClass }}">{{ $step['title'] }}</h4>
                                        <p class="text-xs mt-1 step-time transition-colors duration-500 {{ $timeClass }}"
                                            id="time-step-{{ $stepNumber }}">{{ $stepNumber <= $currentStep ? $step['time'] : __('levels.pending') }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Mobile Vertical Timeline -->
                        <div class="md:hidden relative pl-4 pb-4">
                            <!-- Background Track -->
                            <div class="absolute top-2 bottom-2 left-[37px] w-1 bg-gray-100 rounded-full"></div>
                            <!-- Active Progress Track -->
                            <div id="progressTrackMobile"
                                class="absolute top-2 left-[32px] w-1 bg-brand-500 rounded-full progress-line"
                                style="height: {{ $progressPercentages[$currentStep] }};"></div>

                            <div class="space-y-8 relative z-10">
                                @foreach ($steps as $stepNumber => $step)
                                    @php
                                        $isCompleted = $stepNumber < $currentStep;
                                        $isCurrent = $stepNumber === $currentStep;
                                        $iconClass = $isCompleted ? 'border-brand-500 bg-brand-500 text-white' : ($isCurrent ? 'border-brand-500 bg-brand-50 text-brand-600 shadow-glow icon-bounce' : 'bg-white border-gray-200 text-gray-400');
                                        $titleClass = $stepNumber <= $currentStep ? 'text-brand-900' : 'text-gray-400';
                                        $timeClass = $stepNumber <= $currentStep ? 'text-gray-500' : 'text-gray-400';
                                    @endphp
                                    <div class="timeline-step-mobile flex gap-6" data-step="{{ $stepNumber }}">
                                        <div
                                            class="step-icon w-12 h-12 shrink-0 border-4 rounded-full flex items-center justify-center transition-all duration-500 {{ $iconClass }}">
                                            <i class="{{ $step['icon'] }}"></i>
                                        </div>
                                        <div class="pt-2">
                                            <h4 class="font-bold step-title transition-colors duration-500 {{ $titleClass }}">
                                                {{ $step['title'] }}</h4>
                                            <p class="text-sm mt-1 step-time transition-colors duration-500 {{ $timeClass }}"
                                                id="m-time-step-{{ $stepNumber }}">{{ $stepNumber <= $currentStep ? $step['time'] : __('levels.pending') }}</p>
                                            <p class="text-xs text-gray-500 mt-1 step-desc transition-opacity">
                                                {{ $step['desc'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Details Card -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-brand-100">
                            <h3 class="font-bold text-brand-900 mb-6 flex items-center gap-2">
                                <i class="fas fa-paper-plane text-brand-400"></i> {{ __('levels.shipment_origin') }}
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">{{ __('levels.sender') }}</p>
                                    <p class="font-medium text-gray-800" id="senderName">{{ @$parcel->merchant->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">{{ __('levels.location') }}</p>
                                    <p class="font-medium text-gray-800" id="senderLocation">{{ @$parcel->pickup_address }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">{{ __('levels.date_shipped') }}
                                    </p>
                                    <p class="font-medium text-gray-800" id="shipDate">{{ $parcel ? dateFormat($parcel->created_at) : '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-soft border border-brand-100">
                            <h3 class="font-bold text-brand-900 mb-6 flex items-center gap-2">
                                <i class="fas fa-location-dot text-brand-400"></i> {{ __('levels.destination') }}
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">{{ __('levels.receiver') }}</p>
                                    <p class="font-medium text-gray-800" id="receiverName">{{ @$parcel->customer_name }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">{{ __('levels.address') }}</p>
                                    <p class="font-medium text-gray-800" id="receiverLocation">{{ @$parcel->customer_address }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">{{ __('levels.est_delivery_delivered_on') }}</p>
                                    <p class="font-medium text-brand-600" id="deliveryDate">{{ @$parcel->delivery_date ? dateFormat($parcel->delivery_date) : __('levels.n/a') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- 10. FOOTER -->
@push('scripts')
@endpush

@endsection
