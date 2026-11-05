@extends(active_theme() . '.layouts.master')
@section('title')
    Agents, Sellers &amp; Shops | {{ settings()->name }}
@endsection
@section('content')
@php
    $agentFailed  = $errors->agent->any();
    $pickupFailed = $errors->pickup->any();
    // Only repopulate the form that actually failed.
    $aVal = fn ($key) => $agentFailed ? old($key) : null;
    $pVal = fn ($key) => $pickupFailed ? old($key) : null;
@endphp
<main class="pt-32 pb-24 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-8">

        <!-- Hero Section -->
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Earn with BodaBora</span>
                <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-tight">
                    Sell online, book pickups, or earn as a BodaBora agent
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Whether you run an online shop, a physical store, or you simply want to earn from your own neighbourhood, BodaBora gives you the delivery network, the dashboard and the riders to make it work.
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="#join" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl shadow-md transition">Become an agent or seller</a>
                    <a href="#pickup" class="bg-white hover:bg-gray-50 text-gray-800 font-semibold px-6 py-3 rounded-xl border border-gray-300 shadow-sm transition">Book a pickup</a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-xl border border-gray-100">
                    <h3 class="text-xl font-bold text-emerald-700 mb-6 flex items-center gap-2">
                        <i class="fas fa-gift text-emerald-600"></i> What you get
                    </h3>
                    <ul class="space-y-4 text-gray-700 text-sm">
                        <li class="flex items-start gap-4">
                            <i class="fas fa-motorcycle text-emerald-700 mt-1 fa-lg"></i>
                            <div><strong>Riders on demand:</strong> book a pickup and a rider collects from your shop, stall or home.</div>
                        </li>
                        <li class="flex items-start gap-4">
                            <i class="fas fa-money-bill-wave text-emerald-700 mt-1 fa-lg"></i>
                            <div><strong>Commission for agents:</strong> earn on every parcel you bring to BodaBora.</div>
                        </li>
                        <li class="flex items-start gap-4">
                            <i class="fas fa-box text-emerald-700 mt-1 fa-lg"></i>
                            <div><strong>Cash on delivery handled:</strong> we collect from your buyer and reconcile it in your dashboard.</div>
                        </li>
                        <li class="flex items-start gap-4">
                            <i class="fas fa-chart-line text-emerald-700 mt-1 fa-lg"></i>
                            <div><strong>One dashboard:</strong> orders, pickups, statements and payouts in one place.</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recent Backend Agents & Merchants Table -->
        <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-xl border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Active Network Partners & Agents</h2>
                    <p class="text-gray-600 text-sm mt-1">Recently registered merchants, shops, and agents powered by BodaBora.</p>
                </div>
                <span class="bg-emerald-100 text-emerald-800 font-semibold px-4 py-2 rounded-xl text-xs">Live Backend Data</span>
            </div>

            <div class="overflow-x-auto">
                <!-- Search Bar -->
                <form action="{{ route('agents.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 mb-8">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search partners by name, business, location, or phone..."
                    class="flex-grow h-12 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm bg-gray-50/50" />
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl shadow transition text-sm">Search Partners</button>
                    @if(request('search'))
                    <a href="{{ route('agents.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-3 rounded-xl transition text-sm text-center">Reset</a>
                    @endif
                </form>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-700 uppercase text-xs tracking-wider border-b border-gray-200">
                            <th class="py-3 px-4 font-semibold">Partner Name</th>
                            <th class="py-3 px-4 font-semibold">Business / Shop</th>
                            <th class="py-3 px-4 font-semibold">Location</th>
                            <th class="py-3 px-4 font-semibold">Phone</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($agents ?? [] as $agent)
                        <tr class="hover:bg-gray-50/80 transition">
                            <td class="py-4 px-4 font-bold text-gray-900">{{ $agent->name }}</td>
                            <td class="py-4 px-4 text-gray-600">{{ $agent->business_name ?? 'N/A' }}</td>
                            <td class="py-4 px-4 text-gray-600">{{ $agent->county ?: ($agent->address ?? 'Nairobi, Kenya') }}</td>
                            <td class="py-4 px-4 text-gray-600">{{ $agent->phone }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-gray-500">No network partners found matching your search.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Who it is for -->
        <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-xl border border-gray-100">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Built around how you already work</h2>
                <p class="text-gray-600">Three ways to partner with BodaBora. Pick the one that fits and apply in under a minute.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200">
                    <i class="fas fa-store text-3xl text-emerald-700 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Online sellers</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">You sell on Instagram, Facebook, WhatsApp or your own website. Plug in delivery, offer same-day shipping, and let us handle the cash on delivery.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200">
                    <i class="fas fa-shop text-3xl text-emerald-700 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Existing shops</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">You already run a physical shop, pharmacy or boutique. Add delivery to your counter and start sending parcels for customers around you.</p>
                </div>
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200">
                    <i class="fas fa-handshake text-3xl text-emerald-700 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Agents</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Become a BodaBora agent in your area. Collect parcels, refer merchants and earn a commission on everything that moves through you.</p>
                </div>
            </div>
        </div>

        <!-- How it works -->
        <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-xl border border-gray-100">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">How it works</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full mb-3">Step 1</span>
                    <h3 class="font-bold text-gray-900 mb-2 text-lg">Apply</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Fill the short form below. Tell us where you are and how you want to earn.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full mb-3">Step 2</span>
                    <h3 class="font-bold text-gray-900 mb-2 text-lg">Get verified</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">We call you back, confirm your details and set up your account or agent point.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full mb-3">Step 3</span>
                    <h3 class="font-bold text-gray-900 mb-2 text-lg">Start shipping</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Book pickups from the dashboard or hand parcels to your assigned rider.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full mb-3">Step 4</span>
                    <h3 class="font-bold text-gray-900 mb-2 text-lg">Earn</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Get paid your commissions and delivery revenue directly and securely.</p>
                </div>
            </div>
        </div>

        <!-- Side-by-Side Forms (Equal Length & Connected to DB) -->
        <div class="grid lg:grid-cols-2 gap-8 items-stretch">

            <!-- Become an Agent or Seller Form -->
            <div id="join" class="bg-white rounded-3xl p-8 lg:p-12 shadow-xl border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-8">
                        <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-2">Join Our Network</span>
                        <h2 class="text-3xl font-bold text-gray-900">Become an Agent or Seller</h2>
                        <p class="text-gray-600 mt-2 text-sm">Fill in your details below and our team will get you onboarded right away.</p>
                    </div>

                    @if(session('agent_success'))
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl mb-6 text-sm">
                            {{ session('agent_success') }}
                        </div>
                    @endif

                    <form action="{{ route('agents.apply') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name *</label>
                                <input type="text" name="name" value="{{ $aVal('name') }}" required placeholder="John Doe"
                                class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm" />
                                @error('agent.name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address *</label>
                                <input type="email" name="email" value="{{ $aVal('email') }}" required placeholder="john@example.com"
                                class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm" />
                                @error('agent.email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Phone Number *</label>
                                <input type="text" name="phone" value="{{ $aVal('phone') }}" required placeholder="0712345678"
                                class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm" />
                                @error('agent.phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Account Type *</label>
                                <select name="type" required class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm bg-white">
                                    <option value="">Select Type</option>
                                    <option value="seller" {{ $aVal('type') == 'seller' ? 'selected' : '' }}>Online Seller / E-commerce</option>
                                    <option value="shop" {{ $aVal('type') == 'shop' ? 'selected' : '' }}>Physical Shop / Retail Store</option>
                                    <option value="agent" {{ $aVal('type') == 'agent' ? 'selected' : '' }}>BodaBora Agent</option>
                                </select>
                                @error('agent.type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Business Name & Address *</label>
                            <input type="text" name="business_name" value="{{ $aVal('business_name') }}" required placeholder="Shop Name, Street, Neighborhood"
                            class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm" />
                            @error('agent.business_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Additional Information</label>
                            <textarea name="address" rows="3" placeholder="Tell us about your expected parcel volume..."
                            class="w-full px-4 py-2 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm">{{ $aVal('address') }}</textarea>
                        </div>
                </div>

                <div class="text-center pt-4">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg transition duration-200 w-full">Submit Application</button>
                </div>
                    </form>
            </div>

            <!-- Book a Pickup Form -->
            <div id="pickup" class="bg-white rounded-3xl p-8 lg:p-12 shadow-xl border border-gray-100 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-8">
                        <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-2">Instant Dispatch</span>
                        <h2 class="text-3xl font-bold text-gray-900">Book a Pickup</h2>
                        <p class="text-gray-600 mt-2 text-sm">Need a rider to collect a package right now? Fill out your pickup details below.</p>
                    </div>

                    @if(session('pickup_success'))
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl mb-6 text-sm">
                            {{ session('pickup_success') }}
                        </div>
                    @endif

                    <form action="{{ route('agents.book-pickup') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Sender Name *</label>
                                <input type="text" name="sender_name" value="{{ $pVal('sender_name') }}" required placeholder="John Doe"
                                class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm" />
                                @error('pickup.sender_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Sender Phone *</label>
                                <input type="text" name="sender_phone" value="{{ $pVal('sender_phone') }}" required placeholder="0712345678"
                                class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm" />
                                @error('pickup.sender_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Pickup Address *</label>
                            <input type="text" name="pickup_address" value="{{ $pVal('pickup_address') }}" required placeholder="Street, Building, Landmark"
                            class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm" />
                            @error('pickup.pickup_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Receiver Name *</label>
                                <input type="text" name="receiver_name" value="{{ $pVal('receiver_name') }}" required placeholder="Jane Smith"
                                class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm" />
                                @error('pickup.receiver_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Receiver Phone *</label>
                                <input type="text" name="receiver_phone" value="{{ $pVal('receiver_phone') }}" required placeholder="0798765432"
                                class="w-full h-11 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm" />
                                @error('pickup.receiver_phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Package Description / Notes</label>
                            <textarea name="notes" rows="3" placeholder="Fragile items, clothing, documents..."
                            class="w-full px-4 py-2 rounded-xl border border-gray-200 outline-none focus:border-emerald-500 text-sm">{{ $pVal('notes') }}</textarea>
                        </div>
                </div>

                <div class="text-center pt-4">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg transition duration-200 w-full">Request Rider Pickup</button>
                </div>
                    </form>
            </div>

        </div>

    </div>
</main>
@endsection
