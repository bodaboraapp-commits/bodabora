@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<main>
        <section class="bg-slate-50 py-16">
            <div class="container mx-auto px-4">
                <div class="mx-auto max-w-3xl text-center mb-12">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-600">{{ __('levels.contact_us') }}</p>
                    <h1 class="mt-4 text-3xl font-extrabold text-section-heading-text sm:text-4xl">{{ @$page->title }}</h1>
                    <div class="mt-4 text-sm leading-7 text-slate-600 sm:text-base page-content">{!! $page->description !!}</div>
                </div>

                <div class="grid gap-8 lg:grid-cols-2 mb-12">
                    <div>
                        <div class="rounded-3xl border border-border-green-100 bg-white p-8 shadow-sm">
                            <h2 class="text-xl font-bold text-section-heading-text">{{ __('levels.send_message') }}</h2>
                            <p class="mt-2 text-sm text-slate-600">Tell us your name, email, and the details of your
                                request. We'll get back to you as soon as possible.</p>

                            <form action="{{ route('contact.message.send') }}" method="post" enctype="multipart/form-data" class="mt-8 space-y-4">
                                @csrf
                                <div>
                                    <label for="name" class="text-sm font-medium text-slate-700">{{ __('levels.name') }}</label>
                                    <input id="name" name="name" type="text" placeholder="{{ __('levels.your_name') }}" value="{{ old('name') }}"
                                        class="mt-2 w-full rounded-2xl border border-border-green-100 bg-slate-50 px-4 py-3 text-sm text-section-heading-text outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100" />
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="text-sm font-medium text-slate-700">{{ __('levels.email') }}</label>
                                    <input id="email" name="email" type="email" placeholder="{{ __('levels.enter_email') }}" value="{{ old('email') }}"
                                        class="mt-2 w-full rounded-2xl border border-border-green-100 bg-slate-50 px-4 py-3 text-sm text-section-heading-text outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100" />
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="subject" class="text-sm font-medium text-slate-700">{{ __('levels.subject') }}</label>
                                    <input id="subject" name="subject" type="text" placeholder="{{ __('levels.enter_subject') }}" value="{{ old('subject') }}"
                                        class="mt-2 w-full rounded-2xl border border-border-green-100 bg-slate-50 px-4 py-3 text-sm text-section-heading-text outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100" />
                                    @error('subject')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="message" class="text-sm font-medium text-slate-700">{{ __('levels.message') }}</label>
                                    <textarea id="message" name="message" rows="6" placeholder="{{ __('levels.write_your_message') }}"
                                        class="mt-2 w-full rounded-2xl border border-border-green-100 bg-slate-50 px-4 py-3 text-sm text-section-heading-text outline-none transition focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="inline-flex w-full items-center justify-center rounded-2xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2">Submit
                                    message</button>
                            </form>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-border-green-100 bg-white p-8 shadow-sm">
                        <h2 class="text-xl font-bold text-section-heading-text">{{ __('levels.office_information') }}</h2>
                        <p class="mt-2 text-sm text-slate-600">Reach out directly or stop by our Dhaka office for faster
                            support.</p>
                        <div class="mt-8 space-y-5 text-sm text-slate-700">
                            <div>
                                <p class="font-semibold text-section-heading-text">{{ __('levels.office') }}</p>
                                <p class="mt-1 text-slate-600">{{ settings()->address }}</p>
                            </div>
                            <div>
                                <p class="font-semibold text-section-heading-text">{{ __('levels.phone') }}</p>
                                <a href="tel:{{ settings()->phone }}"
                                    class="mt-1 inline-block text-emerald-600 hover:text-emerald-700">{{ settings()->phone }}</a>
                            </div>
                            <div>
                                <p class="font-semibold text-section-heading-text">{{ __('levels.email') }}</p>
                                <a href="mailto:{{ settings()->email }}"
                                    class="mt-1 inline-block text-emerald-600 hover:text-emerald-700">{{ settings()->email }}</a>
                            </div>
                            <div>
                                <p class="font-semibold text-section-heading-text">{{ __('levels.address') }}</p>
                                <p class="mt-1 text-slate-600">{{ settings()->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if(section(\App\Enums\SectionType::MAP_LINK,'map_link'))
                <div class="overflow-hidden rounded-3xl border border-border-green-100 bg-white shadow-sm p-8">
                    <div class="px-8 py-6">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-600">{{ __('levels.our_location') }}</p>
                        <h3 class="mt-3 text-lg font-bold text-section-heading-text">{{ settings()->address }}</h3>
                        <p class="mt-2 text-sm text-slate-600">Use this map to find our Dhaka office and plan your
                            visit.</p>
                    </div>
                    <div class="h-[320px] sm:h-[360px]">
                        <iframe class="h-full w-full border-0 rounded-3xl mt-5" aria-label="{{ __('levels.dhaka_office_map') }}"
                            src="{{ section(\App\Enums\SectionType::MAP_LINK,'map_link') }}"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </main>

    <!-- Footer -->
@push('scripts')
<!-- script section -->
    <script>
        (function () {
            var toggle = document.getElementById("nav-toggle");
            var panel = document.getElementById("mobile-nav");

            if (!toggle || !panel) return;

            // toggle open/close
            toggle.addEventListener("click", function () {
                var open = panel.classList.toggle("hidden") === false;
                toggle.setAttribute("aria-expanded", open ? "true" : "false");
            });

            //  auto close on menu click
            panel.querySelectorAll("a, button").forEach(function (item) {
                item.addEventListener("click", function () {
                    if (!panel.classList.contains("hidden")) {
                        panel.classList.add("hidden");
                        toggle.setAttribute("aria-expanded", "false");
                    }
                });
            });

        })();
    </script>
@endpush

@endsection
