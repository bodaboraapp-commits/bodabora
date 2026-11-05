<main>
        <section class="relative overflow-hidden bg-white py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl text-center mx-auto">
                    <span
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-badge-bg/20 border border-badge-border text-badge-border text-sm font-semibold backdrop-blur">
                        <i class="fa-solid fa-circle-info"></i>
                        {{ __('levels.about_us') }}
                    </span>
                    <h1 class="mt-8 text-4xl sm:text-5xl font-extrabold text-section-heading-text tracking-tight">
                        {{ @$page->title ?: settings()->name }}
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-section-desc-text">
                        {!! @$page->description ?: section(\App\Enums\SectionType::ABOUT,'about_us') !!}
                    </p>
                </div>
            </div>
        </section>

        <section class="py-16 bg-process-bg">
            <div class="container mx-auto px-4">
                <div class="grid gap-10 lg:grid-cols-3">
                    <div class="rounded-3xl border border-border-green-100 bg-white p-8 shadow-sm">
                        <h2 class="text-xl font-bold text-section-heading-text">{{ __('levels.our_mission') }}</h2>
                        <p class="mt-4 text-section-desc-text leading-relaxed">
                            {{ __('levels.tracking_dashboard_intro') }}
                        </p>
                    </div>
                    <div class="rounded-3xl border border-border-green-100 bg-white p-8 shadow-sm">
                        <h2 class="text-xl font-bold text-section-heading-text">{{ __('levels.our_promise') }}</h2>
                        <p class="mt-4 text-section-desc-text leading-relaxed">
                            {{ __('levels.service_section_intro') }}
                        </p>
                    </div>
                    <div class="rounded-3xl border border-border-green-100 bg-white p-8 shadow-sm">
                        <h2 class="text-xl font-bold text-section-heading-text">{{ __('levels.our_team') }}</h2>
                        <p class="mt-4 text-section-desc-text leading-relaxed">
                            {{ __('levels.support_team_ready') }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.18em] text-calculate-beg-text">{{ __('levels.why_courier') }}
                        </p>
                        <h2 class="mt-3 text-3xl font-extrabold text-section-heading-text tracking-tight">{{ __('levels.trusted_by_happy_customers') }}</h2>
                        <p class="mt-4 max-w-prose text-section-desc-text leading-relaxed">
                            {{ __('levels.cta_join_text') }}
                        </p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-3xl border border-border-green-100 bg-process-bg p-6">
                            <h3 class="text-lg font-bold text-section-heading-text">{{ __('levels.secure') }}</h3>
                            <p class="mt-3 text-section-desc-text leading-relaxed">{{ __('levels.service_section_intro') }}</p>
                        </div>
                        <div class="rounded-3xl border border-border-green-100 bg-process-bg p-6">
                            <h3 class="text-lg font-bold text-section-heading-text">{{ __('levels.book_order') }}</h3>
                            <p class="mt-3 text-section-desc-text leading-relaxed">{{ __('levels.book_order_text') }}</p>
                        </div>
                        <div class="rounded-3xl border border-border-green-100 bg-process-bg p-6">
                            <h3 class="text-lg font-bold text-section-heading-text">{{ __('levels.customer_support') }}</h3>
                            <p class="mt-3 text-section-desc-text leading-relaxed">{{ __('levels.support_team_ready') }}</p>
                        </div>
                        <div class="rounded-3xl border border-border-green-100 bg-process-bg p-6">
                            <h3 class="text-lg font-bold text-section-heading-text">{{ __('levels.nationwide') }}</h3>
                            <p class="mt-3 text-section-desc-text leading-relaxed">{{ __('levels.secure_country_delivery') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-choose-bg-gr-from text-white">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">{{ __('levels.start_shipping_today') }}</h2>
                <p class="mt-4 max-w-2xl mx-auto text-choose-desc-text leading-relaxed">
                    {{ __('levels.cta_join_text') }}
                </p>
                <a href="{{ url('/') }}"
                    class="mt-8 inline-flex items-center justify-center rounded-full bg-white px-8 py-3 text-sm font-semibold text-emerald-700 shadow-lg shadow-emerald-900/10 hover:bg-slate-100 transition-colors duration-300">
                    {{ __('levels.home') }}
                </a>
            </div>
        </section>
    </main>
@push('scripts')
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

