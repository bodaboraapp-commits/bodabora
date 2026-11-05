@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<main>
        <section class="bg-section-grid-bg py-20">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center mb-16">
                    <span
                        class="inline-flex items-center rounded-full border border-section-grid-border bg-white px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] text-section-grid-title">{{ __('levels.faq') }}</span>
                    <h1 class="mt-6 text-4xl sm:text-5xl font-extrabold tracking-tight text-section-heading-text">
                        {{ @$page->title }}</h1>
                    <p class="mt-4 text-base leading-8 text-section-desc-text">{!! \Illuminate\Support\Str::limit(strip_tags(@$page->description ?? ''), 180) !!}</p>
                </div>

                <div id="faq-list" class="grid gap-6"></div>

                <div class="mt-16 rounded-[2rem] border border-section-grid-border bg-emerald-50 p-10 text-center">
                    <p class="text-sm uppercase tracking-[0.3em] text-section-grid-title">{{ __('levels.need_more_help') }}</p>
                    <h3 class="mt-4 text-3xl font-semibold text-section-heading-text">{{ __('levels.still_have_questions') }}</h3>
                    <p class="mt-4 max-w-2xl mx-auto text-section-desc-text">{{ __('levels.support_team_ready') }}</p>
                    <a href="{{ route('contact.send.page') }}"
                        class="mt-8 inline-flex rounded-full bg-emerald-600 px-8 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-600/25 transition hover:bg-emerald-700">{{ __('levels.contact_support') }}</a>
                </div>
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

        function initFaq() {
            var faqList = document.getElementById("faq-list");
            if (!faqList) return;

            var faqItems = @json($faqs->getCollection()->map(function ($faq) {
                return [
                    'question' => $faq->question,
                    'answer' => strip_tags($faq->answer),
                ];
            })->values());

            faqItems.forEach(function (item, index) {
                var card = document.createElement("article");
                card.className = "rounded-3xl border border-section-grid-border bg-white p-8 shadow-sm shadow-emerald-200/40 animate-fade-in";

                var header = document.createElement("button");
                header.type = "button";
                header.className = "w-full text-left flex items-center justify-between gap-4 text-xl font-semibold text-section-grid-title focus:outline-none";
                header.setAttribute("aria-expanded", "false");
                header.innerHTML = "<span>" + item.question + "</span> <i class='fa-solid fa-plus text-emerald-600 transition-transform duration-300'></i>";

                var answer = document.createElement("p");
                answer.className = "mt-4 text-section-grid-text leading-7 overflow-hidden";
                answer.style.maxHeight = "0";
                answer.style.opacity = "0";
                answer.style.transition = "max-height 0.35s ease, opacity 0.25s ease";
                answer.textContent = item.answer;

                header.addEventListener("click", function () {
                    var isExpanded = header.getAttribute("aria-expanded") === "true";
                    header.setAttribute("aria-expanded", !isExpanded);

                    if (isExpanded) {
                        answer.style.maxHeight = "0";
                        answer.style.opacity = "0";
                    } else {
                        answer.style.maxHeight = answer.scrollHeight + "px";
                        answer.style.opacity = "1";
                    }

                    var icon = header.querySelector("i");
                    if (icon) {
                        icon.className = isExpanded ? "fa-solid fa-plus text-emerald-600 transition-transform duration-300" : "fa-solid fa-minus text-emerald-600 transition-transform duration-300";
                    }
                });

                card.appendChild(header);
                card.appendChild(answer);
                faqList.appendChild(card);
            });
        }

        document.addEventListener("DOMContentLoaded", initFaq);
    </script>
@endpush

@endsection
