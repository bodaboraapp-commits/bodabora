@extends(active_theme() . '.layouts.master')
@section('title')
    {{ __('levels.parcel_tracking') }} | {{ @settings()->name }}
@endsection
@section('content')
@php
    $trackingId = $request->tracking_id;
    $currentStep = 1;

    if ($parcel) {
        if (in_array($parcel->status, [\App\Enums\ParcelStatus::RECEIVED_BY_PICKUP_MAN, \App\Enums\ParcelStatus::RECEIVED_WAREHOUSE, \App\Enums\ParcelStatus::TRANSFER_TO_HUB, \App\Enums\ParcelStatus::RECEIVED_BY_HUB])) {
            $currentStep = 2;
        } elseif (in_array($parcel->status, [\App\Enums\ParcelStatus::DELIVERY_MAN_ASSIGN, \App\Enums\ParcelStatus::DELIVERY_RE_SCHEDULE, \App\Enums\ParcelStatus::DELIVER, \App\Enums\ParcelStatus::RETURN_TO_COURIER, \App\Enums\ParcelStatus::RETURN_ASSIGN_TO_MERCHANT, \App\Enums\ParcelStatus::RETURN_MERCHANT_RE_SCHEDULE])) {
            $currentStep = 3;
        } elseif (in_array($parcel->status, [\App\Enums\ParcelStatus::DELIVERED, \App\Enums\ParcelStatus::PARTIAL_DELIVERED])) {
            $currentStep = 4;
        }
    }

    $progressPercentage = (($currentStep - 1) / 3) * 100;
    $statusSlug = $currentStep === 4 ? 'delivered' : ($currentStep === 3 ? 'out-for-delivery' : ($currentStep === 2 ? 'in-transit' : 'pending'));
    $statusBadgeClass = [
        'delivered' => 'bg-[#DCFCE7] text-[#16A34A] border border-[#16A34A]/20',
        'in-transit' => 'bg-blue-50 text-blue-700 border border-blue-200',
        'out-for-delivery' => 'bg-yellow-50 text-yellow-700 border border-yellow-200',
        'pending' => 'bg-gray-50 text-gray-700 border border-gray-200',
    ][$statusSlug];
    $statusIcon = [
        'delivered' => 'fa-circle-check',
        'in-transit' => 'fa-truck-fast',
        'out-for-delivery' => 'fa-box-open',
        'pending' => 'fa-clock',
    ][$statusSlug];
    $steps = [
        1 => ['title' => __('levels.order_processed'), 'icon' => 'fa-clipboard-check', 'date' => $parcel ? dateFormat($parcel->created_at) : '', 'location' => @$parcel->pickup_address],
        2 => ['title' => __('levels.in_transit'), 'icon' => 'fa-plane-departure', 'date' => optional($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::RECEIVED_WAREHOUSE))->created_at ? dateFormat($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::RECEIVED_WAREHOUSE)->created_at) : '', 'location' => optional(optional($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::RECEIVED_WAREHOUSE))->hub)->name ?? ''],
        3 => ['title' => __('levels.out_for_delivery'), 'icon' => 'fa-truck-fast', 'date' => optional($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::DELIVERY_MAN_ASSIGN))->created_at ? dateFormat($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::DELIVERY_MAN_ASSIGN)->created_at) : '', 'location' => @$parcel->customer_address],
        4 => ['title' => __('levels.delivered'), 'icon' => 'fa-house-circle-check', 'date' => optional($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::DELIVERED))->created_at ? dateFormat($parcelevents->firstWhere('parcel_status', \App\Enums\ParcelStatus::DELIVERED)->created_at) : '', 'location' => @$parcel->customer_address],
    ];
@endphp
<main class="flex-grow w-full max-w-7xl mx-auto px-6 lg:px-8 md:py-12 relative">
        <!-- Background accents -->
        <div
            class="absolute top-0 left-0 w-full h-72 bg-gradient-to-b from-[#DCFCE7]/60 to-transparent -z-10 rounded-b-3xl">
        </div>

        <!-- Search Section -->
        <div
            class="glass-panel rounded-[2rem] shadow-sm border border-green-100 p-6 md:p-12 mb-8 transform transition duration-300 hover:shadow-md relative overflow-hidden group">
            <!-- Decorative circle -->
            <div
                class="absolute -right-10 -top-10 w-40 h-40 bg-green-60 rounded-full mix-blend-multiply opacity-50 group-hover:scale-110 transition duration-700">
            </div>

            <div class="text-center max-w-2xl mx-auto mb-10 relative z-10">
                <div
                    class="inline-flex items-center justify-center w-14 h-14 bg-[#DCFCE7] text-[#16A34A] rounded-2xl mb-5 shadow-sm">
                    <i class="fa-solid fa-magnifying-glass-location text-2xl"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 mb-4 tracking-tight">{{ __('levels.track_your_shipment') }}</h1>
                <p class="text-gray-500 text-sm md:text-base leading-relaxed">{{ __('levels.tracking_updates_prompt') }}</p>
            </div>

            <form action="{{ route('tracking.index') }}" method="GET"
                class="flex flex-col md:flex-row gap-3 max-w-3xl mx-auto relative z-10">
                <div class="relative flex-1 group/input">
                    <div
                        class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-gray-400 group-focus-within/input:text-[#16A34A] transition-colors">
                        <i class="fa-solid fa-barcode text-lg"></i>
                    </div>
                    <input type="text" name="tracking_id" value="{{ $trackingId }}"
                        class="w-full pl-14 pr-4 py-4 bg-white border-2 border-gray-100 rounded-2xl focus:ring-0 focus:border-[#16A34A] outline-none transition text-gray-900 font-bold placeholder-gray-400 shadow-sm text-lg"
                        placeholder="{{ __('levels.enter_tracking_id') }}" required>
                </div>
                <button type="submit"
                    class="bg-[#16A34A] hover:bg-green-700 active:scale-95 text-white px-10 py-4 rounded-2xl font-bold transition-all shadow-lg shadow-green-600/30 flex justify-center items-center gap-3 whitespace-nowrap text-lg">
                    <span>{{ __('levels.track_package') }}</span>
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </button>
            </form>

            <div class="mt-8 flex flex-wrap justify-center gap-3 text-xs md:text-sm relative z-10">
                <span class="text-gray-400 font-bold py-1.5 px-2 uppercase tracking-widest text-[10px]">Demo
                    Actions:</span>
                <a href="{{ route('tracking.index', ['tracking_id' => 'FBX-DELIVERED']) }}"
                    class="bg-white hover:bg-[#DCFCE7] text-gray-600 hover:text-[#16A34A] px-4 py-1.5 rounded-full font-semibold transition border border-gray-200 hover:border-[#16A34A]/30 shadow-sm">{{ __('levels.delivered_stat') }}</a>
                <a href="{{ route('tracking.index', ['tracking_id' => 'FBX-TRANSIT']) }}"
                    class="bg-white hover:bg-blue-50 text-gray-600 hover:text-blue-700 px-4 py-1.5 rounded-full font-semibold transition border border-gray-200 hover:border-blue-200 shadow-sm">In
                    Transit</a>
                <a href="{{ route('tracking.index', ['tracking_id' => 'FBX-OUT']) }}"
                    class="bg-white hover:bg-yellow-50 text-gray-600 hover:text-yellow-700 px-4 py-1.5 rounded-full font-semibold transition border border-gray-200 hover:border-yellow-200 shadow-sm">Out
                    for Delivery</a>
                <a href="{{ route('tracking.index', ['tracking_id' => 'FBX-PENDING']) }}"
                    class="bg-white hover:bg-gray-50 text-gray-600 hover:text-gray-900 px-4 py-1.5 rounded-full font-semibold transition border border-gray-200 hover:border-gray-300 shadow-sm">{{ __('levels.pending') }}</a>
                <a href="{{ route('tracking.index', ['tracking_id' => 'FBX-INVALID']) }}"
                    class="bg-white hover:bg-red-50 text-gray-600 hover:text-red-700 px-4 py-1.5 rounded-full font-semibold transition border border-gray-200 hover:border-red-200 shadow-sm">Invalid
                    ID</a>
            </div>
        </div>

        <!-- Loading State -->
        <div class="hidden flex flex-col items-center justify-center py-16">
            <div class="relative w-16 h-16 mb-6">
                <div class="absolute inset-0 border-4 border-[#DCFCE7] rounded-full"></div>
                <div class="absolute inset-0 border-4 border-[#16A34A] rounded-full border-t-transparent animate-spin">
                </div>
                <div class="absolute inset-0 flex items-center justify-center text-[#16A34A]">
                    <i class="fa-solid fa-box-open animate-pulse"></i>
                </div>
            </div>
            <p class="text-gray-600 font-bold text-lg animate-pulse">{{ __('levels.locating_package') }}</p>
        </div>

        <!-- Results Section -->
        <div class="{{ empty($trackingId) ? 'hidden' : '' }} space-y-6">

            <!-- Invalid State -->
            <div class="{{ empty($trackingId) || $parcel ? 'hidden' : '' }} bg-white rounded-[2rem] p-12 text-center shadow-sm border border-red-100">
                <div
                    class="w-24 h-24 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-circle-exclamation text-4xl"></i>
                </div>
                <h2 class="text-3xl font-black text-gray-900 mb-3 tracking-tight">{{ __('levels.tracking_number_not_found') }}</h2>
                <p class="text-gray-500 max-w-md mx-auto text-lg">{{ __('levels.tracking_not_found_info_message', ['id' => $trackingId]) }}</p>
                <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('tracking.index') }}"
                        class="px-8 py-3.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl font-bold transition shadow-md">Try
                        Another Number</a>
                    <a href="{{ route('contact.send.page') }}"
                        class="px-8 py-3.5 bg-white border-2 border-gray-200 hover:border-gray-300 hover:bg-gray-50 text-gray-700 rounded-xl font-bold transition">Contact
                        Support</a>
                </div>
            </div>

            <!-- Valid States Wrapper -->
            <div class="{{ !$parcel ? 'hidden' : '' }} space-y-8">
                <!-- Status Card -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden glow-effect">
                    <!-- Header -->
                    <div
                        class="bg-gray-50/50 border-b border-gray-100 p-8 md:p-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <p class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ __('levels.tracking_id_label') }}</p>
                                <button
                                    class="text-gray-400 hover:text-[#16A34A] transition bg-white w-7 h-7 rounded-md border border-gray-200 flex items-center justify-center shadow-sm"
                                    title="{{ __('levels.copy_id') }}">
                                    <i class="fa-regular fa-copy text-xs"></i>
                                </button>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight font-mono">
                                {{ @$parcel->tracking_id }}</h2>
                        </div>

                        <!-- Status Badge & Date -->
                        <div class="flex flex-col items-start md:items-end gap-3">
                            <div class="flex items-center gap-2.5 px-6 py-3 rounded-2xl font-bold text-sm md:text-base tracking-wide shadow-sm {{ $statusBadgeClass }}">
                                <i class="fa-solid text-lg {{ $statusIcon }}"></i>
                                <span>{{ $parcel ? __('parcelStatus.'.$parcel->status) : '' }}</span>
                            </div>
                            <p
                                class="text-sm text-gray-500 font-medium bg-white px-4 py-2 rounded-xl border border-gray-100">
                                {{ __('levels.est_delivery') }}: <span class="text-gray-900 font-bold">{{ @$parcel->delivery_date ? dateFormat($parcel->delivery_date) : 'N/A' }}</span>
                            </p>
                        </div>
                    </div>

                    <!-- Progress Timeline -->
                    <div class="p-8 md:p-14 relative overflow-hidden bg-white">
                        <div class="relative max-w-4xl mx-auto">
                            <!-- Desktop Horizontal Track -->
                            <div class="absolute top-7 left-0 w-full h-2.5 bg-gray-100 rounded-full hidden md:block">
                            </div>

                            <!-- Desktop Progress fill -->
                            <div class="absolute top-7 left-0 h-2.5 bg-[#16A34A] rounded-full transition-all duration-1000 ease-out hidden md:block shadow-[0_0_15px_rgba(22,163,74,0.5)]"
                                style="width: {{ $progressPercentage }}%"></div>

                            <!-- Mobile Vertical Track -->
                            <div
                                class="absolute top-7 left-[27px] w-2 h-[calc(100%-3.5rem)] bg-gray-100 rounded-full md:hidden">
                            </div>

                            <!-- Mobile Vertical Progress -->
                            <div class="absolute top-7 left-[27px] w-2 bg-[#16A34A] rounded-full transition-all duration-1000 ease-out md:hidden shadow-[0_0_15px_rgba(22,163,74,0.5)]"
                                style="height: {{ $progressPercentage }}%"></div>

                            <!-- Steps -->
                            <div class="relative flex flex-col md:flex-row justify-between gap-12 md:gap-0">
                                @foreach ($steps as $stepNumber => $step)
                                    @php
                                        $stepIndex = $stepNumber - 1;
                                        $currentStepIndex = $currentStep - 1;
                                        $stepCircleClass = $stepIndex < $currentStepIndex ? 'bg-[#16A34A] text-white shadow-md' : ($stepIndex === $currentStepIndex ? 'bg-[#16A34A] text-white shadow-xl shadow-green-600/40 scale-110' : 'bg-gray-100 text-gray-400');
                                    @endphp
                                    <div
                                        class="relative flex md:flex-col items-start md:items-center gap-6 md:gap-5 z-10 w-full md:w-auto group">
                                        <!-- Step Icon Wrapper -->
                                        <div class="relative shrink-0">
                                            <!-- Pulsing ring for current step -->
                                            <div class="{{ $stepIndex === $currentStepIndex && $statusSlug !== 'delivered' ? '' : 'hidden' }} absolute -inset-2 bg-[#16A34A] rounded-full animate-ping opacity-20">
                                            </div>

                                            <div class="w-16 h-16 rounded-full flex items-center justify-center border-4 border-white transition-all duration-500 relative z-10 {{ $stepCircleClass }}">
                                                <i class="fa-solid text-2xl {{ $step['icon'] }} {{ $stepIndex === $currentStepIndex && $statusSlug !== 'delivered' ? 'animate-bounce' : '' }}"></i>

                                                <!-- Checkmark for completed steps -->
                                                <div class="{{ $stepIndex < $currentStepIndex ? '' : 'hidden' }} absolute -bottom-1 -right-1 w-6 h-6 bg-white rounded-full flex items-center justify-center text-[#16A34A] shadow-sm">
                                                    <i class="fa-solid fa-circle-check text-lg"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step Content -->
                                        <div
                                            class="text-left md:text-center md:absolute md:-bottom-24 md:w-48 pt-2 md:pt-0">
                                            <p class="font-black text-lg transition-colors duration-500 tracking-tight {{ $stepIndex <= $currentStepIndex ? 'text-gray-900' : 'text-gray-400' }}">
                                                {{ $step['title'] }}</p>
                                            @if ($step['date'] && $stepIndex <= $currentStepIndex)
                                                <p class="text-sm font-medium text-gray-500 mt-1">{{ $step['date'] }}</p>
                                            @endif
                                            @if ($step['location'] && $stepIndex <= $currentStepIndex)
                                            <div
                                                class="mt-1.5 inline-flex items-center gap-1 text-xs font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded-md">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span>{{ $step['location'] }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Spacer for absolute positioned labels on desktop -->
                        <div class="hidden md:block h-24"></div>
                    </div>
                </div>

                <!-- Shipment Details Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                    <!-- Route Details -->
                    <div
                        class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 md:p-10 lg:col-span-1 hover:shadow-md transition duration-300">
                        <h3 class="text-gray-900 font-black text-xl mb-8 flex items-center gap-3 tracking-tight">
                            <div
                                class="w-10 h-10 rounded-xl bg-[#DCFCE7] text-[#16A34A] flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-route text-lg"></i>
                            </div>
                            {{ __('levels.journey') }}
                        </h3>
                        <div class="space-y-8 relative">
                            <!-- Connecting Line -->
                            <div class="absolute left-[19px] top-8 bottom-8 w-[2px] bg-gray-100"></div>

                            <!-- Origin -->
                            <div class="relative pl-12 group">
                                <div
                                    class="absolute left-0 top-1 w-10 h-10 rounded-full bg-white flex items-center justify-center border-2 border-gray-200 z-10 transition-colors group-hover:border-[#16A34A]">
                                    <div
                                        class="w-3 h-3 rounded-full bg-gray-300 group-hover:bg-[#16A34A] transition-colors">
                                    </div>
                                </div>
                                <p class="text-xs text-gray-400 font-black uppercase tracking-widest mb-1">{{ __('levels.origin') }}</p>
                                <p class="text-lg font-black text-gray-900 tracking-tight">{{ @$parcel->pickup_address }}</p>
                                <p class="text-sm font-medium text-gray-500 mt-1">{{ $parcel ? dateFormat($parcel->created_at) : '' }}</p>
                            </div>

                            <!-- Destination -->
                            <div class="relative pl-12 group">
                                <div
                                    class="absolute left-0 top-1 w-10 h-10 rounded-full bg-white flex items-center justify-center border-2 border-[#16A34A] z-10 shadow-[0_0_10px_rgba(22,163,74,0.3)]">
                                    <i class="fa-solid fa-location-dot text-[#16A34A] text-sm animate-pulse"></i>
                                </div>
                                <p class="text-xs text-gray-400 font-black uppercase tracking-widest mb-1">{{ __('levels.destination') }}
                                </p>
                                <p class="text-lg font-black text-gray-900 tracking-tight">{{ @$parcel->customer_address }}
                                </p>
                                <p class="text-sm font-medium text-gray-500 mt-1">{{ @$parcel->delivery_date ? dateFormat($parcel->delivery_date) : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Package Info -->
                    <div
                        class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 md:p-10 lg:col-span-2 flex flex-col hover:shadow-md transition duration-300">
                        <h3 class="text-gray-900 font-black text-xl mb-8 flex items-center gap-3 tracking-tight">
                            <div
                                class="w-10 h-10 rounded-xl bg-gray-900 text-white flex items-center justify-center shadow-sm">
                                <i class="fa-solid fa-box-open text-lg"></i>
                            </div>
                            {{ __('levels.package_details') }}
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 flex-grow">
                            <div
                                class="bg-gray-50 border border-gray-100 rounded-2xl p-5 transition-all duration-300 hover:bg-white hover:shadow-lg hover:-translate-y-1 group">
                                <div class="text-gray-300 mb-3 group-hover:text-[#16A34A] transition-colors"><i
                                        class="fa-solid fa-layer-group text-2xl"></i></div>
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">{{ __('levels.service') }}</p>
                                <p class="text-base font-black text-gray-900">{{ @$parcel->delivery_type_name }}</p>
                            </div>
                            <div
                                class="bg-gray-50 border border-gray-100 rounded-2xl p-5 transition-all duration-300 hover:bg-white hover:shadow-lg hover:-translate-y-1 group">
                                <div class="text-gray-300 mb-3 group-hover:text-[#16A34A] transition-colors"><i
                                        class="fa-solid fa-weight-scale text-2xl"></i></div>
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">{{ __('levels.weight') }}</p>
                                <p class="text-base font-black text-gray-900">{{ @$parcel->weight }} {{ @$parcel->deliveryCategory->title }}</p>
                            </div>
                            <div
                                class="bg-gray-50 border border-gray-100 rounded-2xl p-5 transition-all duration-300 hover:bg-white hover:shadow-lg hover:-translate-y-1 group">
                                <div class="text-gray-300 mb-3 group-hover:text-[#16A34A] transition-colors"><i
                                        class="fa-solid fa-ruler-combined text-2xl"></i></div>
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">{{ __('levels.dimensions') }}</p>
                                <p class="text-base font-black text-gray-900">{{ @$parcel->cash_collection }}</p>
                            </div>
                            <div
                                class="bg-gray-50 border border-gray-100 rounded-2xl p-5 transition-all duration-300 hover:bg-white hover:shadow-lg hover:-translate-y-1 group">
                                <div class="text-gray-300 mb-3 group-hover:text-[#16A34A] transition-colors"><i
                                        class="fa-solid fa-user text-2xl"></i></div>
                                <p class="text-xs text-gray-500 font-bold uppercase tracking-wider mb-1">{{ __('levels.receiver') }}</p>
                                <p class="text-base font-black text-gray-900">{{ @$parcel->customer_name }}</p>
                            </div>
                        </div>

                        <div
                            class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4 bg-gray-50 rounded-xl px-6 py-4">
                            <p class="text-sm font-bold text-gray-500">{{ __('levels.need_help_with_shipment') }}</p>
                            <button
                                class="bg-white border border-gray-200 px-5 py-2 rounded-lg text-gray-900 font-bold text-sm hover:border-[#16A34A] hover:text-[#16A34A] transition shadow-sm flex items-center gap-2">
                                Contact Support <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- ================= FOOTER ================= -->
@push('scripts')
<script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        function setMobileMenu(isOpen) {
            if (isOpen) {
                mobileMenu.classList.remove('hidden');
                requestAnimationFrame(() => {
                    mobileMenu.classList.add('open');
                });
                mobileMenuButton.setAttribute('aria-expanded', 'true');
                mobileMenu.setAttribute('aria-hidden', 'false');
            } else {
                mobileMenu.classList.remove('open');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
                setTimeout(() => mobileMenu.classList.add('hidden'), 300);
            }
        }

        mobileMenuButton?.addEventListener('click', () => {
            setMobileMenu(!mobileMenu.classList.contains('open'));
        });

        mobileMenu?.querySelectorAll('a, button').forEach(item => {
            item.addEventListener('click', () => setMobileMenu(false));
        });
    </script>

@endpush

@endsection
