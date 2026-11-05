@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<!-- FAQ section -->
    <main class="py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl font-extrabold mb-4">{{ @$page->title }}</h1>
                <p class="text-gray-600 mb-6">{!! @$page->description !!}</p>

                <div class="flex items-center gap-3 mb-6">
                    <input id="faq-search" type="search" placeholder="{{ __('levels.search') }} {{ __('levels.faq') }}..."
                        class="flex-1 h-12 px-4 rounded-lg border border-gray-200 outline-none focus:border-emerald-400" />
                    <button id="expand-all"
                        class="px-4 py-2 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-600">Expand
                        All</button>
                    <button id="collapse-all" class="px-4 py-2 rounded-lg bg-white border border-gray-200">Collapse
                        All</button>
                </div>

                <div id="faq-list" class="space-y-3">
                    @foreach ($faqs as $key => $faq)
                        <div class="faq-item bg-white rounded-xl shadow p-4">
                            <button class="faq-q w-full text-left flex items-center justify-between gap-4"
                                aria-expanded="false">
                                <span class="font-medium">{{ @$faq->question }}</span>
                                <svg class="w-5 h-5 transform" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                                    <path d="M6 8l4 4 4-4" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <div class="faq-a mt-3 text-gray-600 hidden">{!! $faq->answer !!}</div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5">
                    {{ $faqs->links() }}
                </div>
            </div>
        </div>
    </main>



    <!-- ================= FOOTER ================= -->
@push('scripts')
<style>
        .active-tab {
            border: 2px solid #10b981;
            transform: translateX(6px);
        }
    </style>
    <script>
        (function () {
            const faqList = document.getElementById('faq-list');
            const items = Array.from(faqList.querySelectorAll('.faq-item'));
            const search = document.getElementById('faq-search');
            const expandAllBtn = document.getElementById('expand-all');
            const collapseAllBtn = document.getElementById('collapse-all');

            function setOpen(item, open) {
                const btn = item.querySelector('.faq-q');
                const panel = item.querySelector('.faq-a');
                btn.setAttribute('aria-expanded', open);
                if (open) {
                    panel.classList.remove('hidden');
                    btn.querySelector('svg').classList.add('rotate-180');
                } else {
                    panel.classList.add('hidden');
                    btn.querySelector('svg').classList.remove('rotate-180');
                }
            }

            // Toggle when question clicked
            items.forEach(it => {
                it.querySelector('.faq-q').addEventListener('click', () => {
                    const isOpen = it.querySelector('.faq-q').getAttribute('aria-expanded') === 'true';
                    setOpen(it, !isOpen);
                });
            });

            // Expand / collapse all
            expandAllBtn.addEventListener('click', () => items.forEach(it => setOpen(it, true)));
            collapseAllBtn.addEventListener('click', () => items.forEach(it => setOpen(it, false)));

            // Filter
            function filterFAQs(term) {
                const q = term.trim().toLowerCase();
                items.forEach(it => {
                    const question = it.querySelector('.faq-q span').innerText.toLowerCase();
                    const answer = it.querySelector('.faq-a').innerText.toLowerCase();
                    const match = question.includes(q) || answer.includes(q);
                    it.style.display = match ? '' : 'none';
                });
            }

            search.addEventListener('input', (e) => filterFAQs(e.target.value));

            // keyboard: allow Enter/Space already handled by button element
        })();
    </script>



    <style>
        .animate-fade-in {
            animation: fadeIn 0.25s ease-out;
        }

        .mobile-menu {
            max-height: 0;
            opacity: 0;
            transform: translateY(-8px);
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease, transform 0.3s ease;
        }

        .mobile-menu.open {
            max-height: 900px;
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        function setMobileMenuState(isOpen) {
            mobileMenu.classList.toggle('open', isOpen);
            mobileMenu.setAttribute('aria-hidden', String(!isOpen));
            mobileMenuButton.setAttribute('aria-expanded', String(isOpen));
        }

        mobileMenuButton?.addEventListener('click', () => {
            setMobileMenuState(!mobileMenu.classList.contains('open'));
        });

        mobileMenu?.querySelectorAll('a, button').forEach(item => {
            item.addEventListener('click', () => setMobileMenuState(false));
        });


    </script>
@endpush

@endsection
