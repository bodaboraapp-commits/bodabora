<main>
        <div class="container mx-auto px-4">
            <div class="py-24">
                <h1 class="text-3xl font-bold text-left text-section-heading-text">{{ @$page->title ?: __('levels.privacy_policy') }}</h1>
                <div class="mt-6 text-lg leading-relaxed text-section-desc-text text-left page-content">{!! @$page->description ?: section(\App\Enums\SectionType::ABOUT,'about_us') !!}</div>
            </div>
        </div>
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

