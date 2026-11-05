@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<!-- ========================================= -->
    <!-- CONTACT -->
    <!-- ========================================= -->
    <main class="py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center max-w-3xl mx-auto">
                <p class="text-sm uppercase tracking-[0.3em] text-green-600 font-semibold">{{ __('levels.contact_us') }}</p>
                <h1 class="mt-4 text-4xl lg:text-5xl font-black text-section-text">{{ @$page->title }}</h1>
                <div class="mt-5 text-body-text text-base leading-8 page-content">{!! $page->description !!}</div>
            </div>

            <div class="mt-16 grid gap-10 lg:grid-cols-[1.05fr_1fr]">

                <div class="rounded-[2rem] bg-white p-10 shadow-xl shadow-green-100/50 border border-border-green-100">
                    <h2 class="text-2xl font-black text-section-text">{{ __('levels.our_office') }}</h2>
                    <p class="mt-4 text-body-text leading-7">Visit our Dhaka office or contact us through email and
                        phone. We are here to help with all your courier and shipping needs.</p>

                    <div class="mt-8 space-y-6">
                        <div>
                            <h3 class="font-semibold text-section-heading-text">{{ __('levels.address') }}</h3>
                            <p class="mt-2 text-body-text">{{ settings()->address }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-section-heading-text">{{ __('levels.location') }}</h3>
                            <p class="mt-2 text-body-text">{{ settings()->address }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-section-heading-text">{{ __('levels.email') }}</h3>
                            <p class="mt-2 text-body-text">{{ settings()->email }}</p>
                        </div>
                        <div>
                            <h3 class="font-semibold text-section-heading-text">{{ __('levels.phone') }}</h3>
                            <p class="mt-2 text-body-text">{{ settings()->phone }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] bg-white p-10 shadow-xl shadow-green-100/50 border border-border-green-100">
                    <h2 class="text-2xl font-black text-section-text">{{ __('levels.send_message') }}</h2>
                    <form action="{{ route('contact.message.send') }}" method="post" enctype="multipart/form-data" class="mt-8 space-y-6">
                        @csrf
                        <div class="grid gap-6">
                            <label class="block">
                                <span class="text-sm font-semibold text-section-heading-text">{{ __('levels.name') }}</span>
                                <input type="text" name="name" placeholder="{{ __('levels.your_name') }}" value="{{ old('name') }}"
                                    class="mt-2 w-full rounded-3xl border border-border-green-100 bg-slate-50 px-4 py-3 text-body-text outline-none focus:border-green-500" />
                                @error('name')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="block">
                                <span class="text-sm font-semibold text-section-heading-text">{{ __('levels.email') }}</span>
                                <input type="email" name="email" placeholder="{{ __('levels.enter_email') }}" value="{{ old('email') }}"
                                    class="mt-2 w-full rounded-3xl border border-border-green-100 bg-slate-50 px-4 py-3 text-body-text outline-none focus:border-green-500" />
                                @error('email')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="block">
                                <span class="text-sm font-semibold text-section-heading-text">{{ __('levels.subject') }}</span>
                                <input type="text" name="subject" placeholder="{{ __('levels.enter_subject') }}" value="{{ old('subject') }}"
                                    class="mt-2 w-full rounded-3xl border border-border-green-100 bg-slate-50 px-4 py-3 text-body-text outline-none focus:border-green-500" />
                                @error('subject')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="block">
                                <span class="text-sm font-semibold text-section-heading-text">{{ __('levels.message') }}</span>
                                <textarea name="message" rows="5" placeholder="{{ __('levels.write_your_message') }}"
                                    class="mt-2 w-full rounded-[1.5rem] border border-border-green-100 bg-slate-50 px-4 py-3 text-body-text outline-none focus:border-green-500">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                        <button type="submit"
                            class="cursor-pointer w-full inline-flex items-center justify-center rounded-full bg-gradient-to-r from-green-500 to-green-700 px-6 py-3 text-white font-semibold shadow-lg shadow-green-200/50 hover:scale-[1.01] transition">{{ __('levels.submit') }}</button>
                    </form>
                </div>

            </div>

            @if(section(\App\Enums\SectionType::MAP_LINK,'map_link'))
            <div
                class="mt-16 rounded-[2rem] overflow-hidden border border-border-green-100 shadow-xl shadow-green-100/40">
                <div class="bg-white px-8 py-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-green-600">{{ __('levels.office_location') }}</p>
                    <h2 class="mt-3 text-2xl font-black text-section-text">{{ settings()->address }}</h2>
                    <p class="mt-3 text-body-text max-w-2xl">Find our Dhaka office on the map and get directions
                        straight from your location.</p>
                </div>
                <div class="h-96">
                    <iframe class="w-full h-full border-0" loading="lazy" allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="{{ section(\App\Enums\SectionType::MAP_LINK,'map_link') }}"></iframe>
                </div>
            </div>
            @endif

        </div>
    </main>




    <!-- ========================================= -->
    <!-- FOOTER -->
    <!-- ========================================= -->
@push('scripts')
<!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@endsection
