@extends(active_theme() . '.layouts.master')
@section('title')
    ⚡ ebikeGO - Electric Bike Green Fleet Investment | {{ settings()->name }}
@endsection
@section('content')
@php
    // Single source of truth for the scheme figures (see config/rxcourier.php).
    $bikePrice    = (int) config('rxcourier.ev_investment.bike_price', 195000);
    $dailyEarning = (int) config('rxcourier.ev_investment.daily_earning', 650);

    // Cache-bust the hero image: without this, browsers keep serving the old
    // file from cache because the URL never changes.
    $ebikeImage        = 'frontend/images/ebike-go.png';
    $ebikeImageVersion = @filemtime(public_path($ebikeImage)) ?: 1;
@endphp
<main class="py-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <!-- Hero Section -->
        <div class="grid lg:grid-cols-2 gap-12 items-center mb-10">
            <div class="space-y-6">
                <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">GREEN FLEET INVESTMENT</span>
                <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">
                    Invest in Electric Bikes, Put Them to Work Under BodaBora, &amp; Earn Daily Returns
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Join the green logistics revolution! Fund high-performance electric motorcycles deployed directly into BodaBora’s bustling 24/7 delivery and e-commerce fulfillment network. Enjoy hassle-free passive income while eliminating fossil fuel expenses and lowering carbon emissions.
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="#calculator" class="bg-emerald-600 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition hover:shadow-lg">Calculate ROI</a>
                    <a href="#registerForm" class="bg-white text-gray-800 font-semibold px-6 py-3 rounded-xl border border-gray-200 shadow-sm transition hover:bg-gray-50">Register as Investor</a>
                </div>
            </div>

            <div class="relative flex justify-center">
                {{-- Glow + float treatment, matching the home page hero image --}}
                <div class="absolute w-[450px] h-[450px] rounded-full bg-emerald-100 blur-3xl opacity-40"></div>
                <img src="{{ static_asset($ebikeImage) }}?v={{ $ebikeImageVersion }}" alt="ebikeGO electric delivery bike"
                    class="relative z-10 w-full max-w-xl floating drop-shadow-2xl">
            </div>
        </div>

        <!-- Why Invest Section -->
        <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 mb-10">
            <h3 class="text-xl font-bold text-emerald-700 mb-6 flex items-center gap-2">
                <i class="fas fa-leaf"></i> Why Invest in BodaBora EV?
            </h3>
            <ul class="grid md:grid-cols-2 gap-4 text-gray-700 text-sm">
                <li class="flex items-start gap-4">
                    <i class="fas fa-check-circle text-emerald-700 mt-1"></i>
                    <div><strong>Zero Fuel Costs:</strong> Electric power cuts operating expenses by 70%.</div>
                </li>
                <li class="flex items-start gap-4">
                    <i class="fas fa-check-circle text-emerald-700 mt-1"></i>
                    <div><strong>24/7 Utilization:</strong> Bikes are deployed immediately into active parcel dispatch.</div>
                </li>
                <li class="flex items-start gap-4">
                    <i class="fas fa-check-circle text-emerald-700 mt-1"></i>
                    <div><strong>Guaranteed Payouts:</strong> Daily automated revenue share &amp; earnings.</div>
                </li>
                <li class="flex items-start gap-4">
                    <i class="fas fa-check-circle text-emerald-700 mt-1"></i>
                    <div><strong>Full Asset Insurance:</strong> Fully insured against theft and damage.</div>
                </li>
            </ul>
        </div>

        <!-- Interactive ROI Calculator Section -->
        <div id="calculator" class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 mb-10">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Interactive EV Investment ROI Calculator</h2>
                <p class="text-gray-600">Slide to choose how many electric bikes you want to fund and instantly calculate your estimated returns.</p>
            </div>

            {{-- No items-center here: grid items stretch by default, so both calculator
                 cards render at the same height. --}}
            <div class="grid lg:grid-cols-2 gap-10">
                <div class="space-y-6 bg-gray-50 p-8 rounded-2xl border border-gray-200">
                    <div>
                        <label for="bikesRange" class="block text-sm font-semibold text-gray-700 mb-2">
                            Number of Electric Bikes: <span id="bikesCountDisplay" class="text-emerald-700 font-bold text-xl">2</span> Bikes
                        </label>
                        <input type="range" class="ev-range w-full" min="1" max="50" step="1" value="2" id="bikesRange">
                        {{-- Ruler scale. Ticks are positioned at (v-1)/49 so each one lines up with the thumb. --}}
                        <div class="ev-ruler" aria-hidden="true">
                            @for ($tick = 1; $tick <= 50; $tick++)
                                <span class="ev-tick {{ $tick % 10 === 0 ? 'ev-tick-major' : ($tick % 5 === 0 ? 'ev-tick-mid' : '') }}" style="left: {{ round((($tick - 1) / 49) * 100, 4) }}%">
                                    @if ($tick === 1 || $tick % 10 === 0)<em>{{ $tick }}</em>@endif
                                </span>
                            @endfor
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                        <span class="text-gray-600 text-sm">Cost per Bike:</span>
                        <span class="font-bold text-gray-900">KSh {{ number_format($bikePrice) }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-3">
                        <span class="text-gray-600 text-sm">Est. Daily Earning per Bike:</span>
                        <span class="font-bold text-emerald-700">KSh {{ number_format($dailyEarning) }} net</span>
                    </div>
                </div>

                {{-- flex + justify-between so the heading sits at the top and the figures
                     settle at the bottom, filling the stretched card evenly. --}}
                <div class="bg-emerald-600 text-white p-8 rounded-2xl space-y-6 flex flex-col justify-between">
                    <h3 class="text-xl font-bold border-b border-emerald-300">Your Projected Returns</h3>
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <span class="text-emerald-100 text-xs block uppercase tracking-wider">Total Investment</span>
                            <span id="totalInvestment" class="text-2xl font-black">KSh {{ number_format(2 * $bikePrice) }}</span>
                        </div>
                        <div>
                            <span class="text-emerald-100 text-xs block uppercase tracking-wider">Monthly Return</span>
                            <span id="monthlyReturn" class="text-2xl font-black">KSh {{ number_format(2 * $dailyEarning * 30) }}</span>
                        </div>
                        <div>
                            <span class="text-emerald-100 text-xs block uppercase tracking-wider">Annual ROI</span>
                            <span class="text-xl font-bold">~28.5%</span>
                        </div>
                        <div>
                            <span class="text-emerald-100 text-xs block uppercase tracking-wider">Est. Payback</span>
                            <span class="text-xl font-bold">14 Months</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registration Form Section -->
        <div id="registerForm" class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Register Your Investment Interest</h2>
                <p class="text-gray-600">Secure your slots in our upcoming Green Fleet deployment. Our investment desk reaches out within 24 hours — this takes about a minute.</p>
            </div>

            <form action="{{ route('ev.invest.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Identity -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name (as on your ID) *</label>
                        <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="name" name="name" value="{{ old('name') }}" required placeholder="John Doe">
                        @error('name')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                        <input type="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="email" name="email" value="{{ old('email') }}" required placeholder="john@example.com">
                        @error('email')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number / M-Pesa *</label>
                        <input type="tel" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="0712 345 678">
                        @error('phone')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="country" class="block text-sm font-semibold text-gray-700 mb-2">Country *</label>
                        <select class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="country" name="country" required>
                            @foreach (['Kenya', 'Uganda', 'Tanzania', 'Rwanda', 'Burundi', 'South Sudan', 'Nigeria', 'South Africa', 'United States', 'United Kingdom', 'Other'] as $option)
                                <option value="{{ $option }}" @selected(old('country', 'Kenya') === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('country')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="national_id" class="block text-sm font-semibold text-gray-700 mb-2">National ID / Passport Number *</label>
                        <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="national_id" name="national_id" value="{{ old('national_id') }}" required placeholder="12345678">
                        <p class="text-xs text-gray-600 mt-1">Used only to verify your identity — never shared or sold.</p>
                        @error('national_id')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="bikes_count_input" class="block text-sm font-semibold text-gray-700 mb-2">Number of Bikes to Fund *</label>
                        <input type="number" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="bikes_count_input" name="bikes_count" value="{{ old('bikes_count', 2) }}" min="1" max="50" required>
                        @error('bikes_count')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Pledged capital (derived, confirmed by the team before payment) -->
                <div>
                    <label for="total_investment_input" class="block text-sm font-semibold text-gray-700 mb-2">Total Capital (KSh) *</label>
                    <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 outline-none text-sm font-bold text-gray-800" id="total_investment_input" name="total_investment" value="{{ old('total_investment', 2 * $bikePrice) }}" readonly>
                    <p class="text-xs text-gray-600 mt-1">Calculated from your bike count. Nothing is charged now — our team confirms every figure with you first.</p>
                    @error('total_investment')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-2">Preferred Payment Method *</label>
                        <select class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="payment_method" name="payment_method" required>
                            @foreach (['M-Pesa', 'Bank Transfer', 'Cheque', 'Other'] as $option)
                                <option value="{{ $option }}" @selected(old('payment_method') === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('payment_method')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="referral_source" class="block text-sm font-semibold text-gray-700 mb-2">How did you hear about us? *</label>
                        <select class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="referral_source" name="referral_source" required>
                            <option value="">Please select…</option>
                            @foreach (['Social media (Facebook / Instagram / TikTok)', 'Google search', 'Friend or family referral', 'BodaBora rider or merchant', 'Radio / TV', 'Event or roadshow', 'Other'] as $option)
                                <option value="{{ $option }}" @selected(old('referral_source') === $option)>{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('referral_source')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Optional KYC: native <details>, collapsed by default so it never slows anyone down -->
                <details class="bg-gray-50 rounded-2xl p-8 border border-dashed border-gray-200">
                    <summary class="text-sm font-bold text-gray-900 cursor-pointer">Optional — add these now to speed up verification</summary>
                    <div class="grid md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="date_of_birth" class="block text-sm font-semibold text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="county" class="block text-sm font-semibold text-gray-700 mb-2">County / Town</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="county" name="county" value="{{ old('county') }}" placeholder="Nairobi">
                            @error('county')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="occupation" class="block text-sm font-semibold text-gray-700 mb-2">Occupation / Source of Funds</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="occupation" name="occupation" value="{{ old('occupation') }}" placeholder="Business owner">
                            @error('occupation')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="kra_pin" class="block text-sm font-semibold text-gray-700 mb-2">KRA PIN (for returns &amp; tax)</label>
                            <input type="text" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="kra_pin" name="kra_pin" value="{{ old('kra_pin') }}" placeholder="A123456789Z">
                            @error('kra_pin')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                        </div>
                        <div class="md:col-span-2">
                            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Anything else we should know?</label>
                            <textarea class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400 text-sm" id="notes" name="notes" rows="3" placeholder="Preferred callback time, questions, etc.">{{ old('notes') }}</textarea>
                            @error('notes')<p class="text-xs mt-1" style="color:#dc2626">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </details>

                <!-- Consent -->
                <div class="flex items-start gap-4 bg-gray-50 rounded-2xl p-8 border border-gray-200">
                    <input type="checkbox" id="consent" name="consent" value="1" required @checked(old('consent')) class="mt-1" style="width:1.1rem;height:1.1rem;flex:0 0 auto">
                    <label for="consent" class="text-sm text-gray-700">I confirm the details above are accurate, and I consent to BodaBora processing them to assess my investment application and contact me about the Green Fleet programme. *</label>
                </div>
                @error('consent')<p class="text-xs" style="color:#dc2626">{{ $message }}</p>@enderror

                <div class="text-center pt-3">
                    <button type="submit" class="inline-block bg-emerald-600 text-white font-bold px-10 py-4 rounded-2xl shadow-lg transition hover:shadow-lg w-full md:w-auto">Submit Investment Application</button>
                    <p class="text-xs text-gray-600 mt-2">No payment is taken now. Submitting this form does not commit you to invest.</p>
                </div>
            </form>
        </div>

    </div>
</main>

@push('styles')
<style>
    /* ebikeGO bike-count slider: green track/thumb plus a ruler scale underneath */
    .ev-range {
        -webkit-appearance: none;
        appearance: none;
        width: 100%;
        height: 1.5rem;
        background: transparent;
        cursor: pointer;
    }

    .ev-range:focus {
        outline: none;
    }

    /* WebKit / Blink */
    .ev-range::-webkit-slider-runnable-track {
        height: 0.5rem;
        border-radius: 999px;
        background: linear-gradient(to right, #059669 0 var(--ev-fill, 2%), #e5e7eb var(--ev-fill, 2%) 100%);
    }

    .ev-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        margin-top: -0.375rem;
        height: 1.25rem;
        width: 1.25rem;
        border: 3px solid #ffffff;
        border-radius: 50%;
        background: #059669;
        box-shadow: 0 1px 4px rgba(15, 23, 42, 0.35);
    }

    .ev-range:focus-visible::-webkit-slider-thumb {
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.25);
    }

    /* Firefox */
    .ev-range::-moz-range-track {
        height: 0.5rem;
        border-radius: 999px;
        background: #e5e7eb;
    }

    .ev-range::-moz-range-progress {
        height: 0.5rem;
        border-radius: 999px;
        background: #059669;
    }

    .ev-range::-moz-range-thumb {
        height: 1.25rem;
        width: 1.25rem;
        border: 3px solid #ffffff;
        border-radius: 50%;
        background: #059669;
        box-shadow: 0 1px 4px rgba(15, 23, 42, 0.35);
    }

    .ev-range:focus-visible::-moz-range-thumb {
        box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.25);
    }

    /* Ruler scale. The 0.625rem side margin is half the thumb width, so the first
       and last ticks sit directly under the thumb at its extremes. */
    .ev-ruler {
        position: relative;
        height: 2.25rem;
        margin: 0.35rem 0.625rem 0;
    }

    .ev-tick {
        position: absolute;
        top: 0;
        width: 1px;
        height: 0.3rem;
        background: #cbd5e1;
        transform: translateX(-50%);
    }

    .ev-tick-mid {
        height: 0.5rem;
        background: #94a3b8;
    }

    .ev-tick-major {
        height: 0.75rem;
        background: #64748b;
    }

    .ev-tick em {
        position: absolute;
        top: 0.9rem;
        left: 50%;
        transform: translateX(-50%);
        font-size: 0.6875rem;
        font-style: normal;
        line-height: 1;
        color: #64748b;
        white-space: nowrap;
    }
</style>
@endpush

@push('scripts')
<script>
    const range = document.getElementById('bikesRange');
    const display = document.getElementById('bikesCountDisplay');
    const totalInv = document.getElementById('totalInvestment');
    const monthlyRet = document.getElementById('monthlyReturn');
    const bikesInput = document.getElementById('bikes_count_input');
    const totalInvInput = document.getElementById('total_investment_input');

    const costPerBike = {{ $bikePrice }};
    const monthlyPerBike = {{ $dailyEarning }} * 30;
    const minBikes = parseInt(range.min, 10) || 1;
    const maxBikes = parseInt(range.max, 10) || 50;

    function renderFigures(val) {
        display.textContent = val;
        bikesInput.value = val;
        const total = val * costPerBike;
        const monthly = val * monthlyPerBike;
        totalInv.textContent = 'KSh ' + total.toLocaleString();
        monthlyRet.textContent = 'KSh ' + monthly.toLocaleString();
        totalInvInput.value = total;
        // Move the green fill so it tracks the thumb.
        const pct = ((val - minBikes) / (maxBikes - minBikes)) * 100;
        range.style.setProperty('--ev-fill', pct + '%');
    }

    range.addEventListener('input', function() {
        renderFigures(parseInt(this.value));
    });

    bikesInput.addEventListener('input', function() {
        const val = parseInt(this.value) || minBikes;
        range.value = val;
        renderFigures(val);
    });

    // Paint the initial state so the track is already green on first load.
    renderFigures(parseInt(range.value) || minBikes);
</script>
@endpush
@endsection
