@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<!-- faq section -->
    <main>
        <section id="faq" class="relative bg-white py-20">
            <div class="blob-bg bg-emerald-200/70 w-72 h-72 top-0 right-16"></div>
            <div class="container mx-auto px-6 lg:px-12 relative">
                <div class="mx-auto max-w-4xl text-center mb-14">
                    <span class="inline-flex rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-700">{{ __('levels.read_our_commonly_asked_questions') }}</span>
                    <h1 class="mt-6 text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900">{{ @$page->title }}</h1>
                    <p class="mt-4 text-base leading-8 text-slate-600">{!! @$page->description !!}</p>
                </div>

                <div class="space-y-4">
                    @foreach ($faqs as $key => $faq)
                        <article class="faq-card rounded-[1.75rem] border border-slate-200 bg-slate-50 overflow-hidden shadow-sm">
                            <button class="faq-toggle flex w-full items-center justify-between gap-4 px-6 py-6 text-left text-slate-900 transition hover:bg-slate-100" type="button" aria-expanded="false">
                                <span class="text-lg font-semibold">{{ @$faq->question }}</span>
                                <span class="faq-icon text-emerald-600">+</span>
                            </button>
                            <div class="faq-panel max-h-0 overflow-hidden px-6 text-slate-600 transition-[max-height] duration-500 ease-out">
                                <div class="pb-6 leading-7">{!! $faq->answer !!}</div>
                            </div>
                        </article>
                    @endforeach
                </div>
                <div class="mt-5">
                    {{ $faqs->links() }}
                </div>
            </div>
        </section>
    </main>
    <!-- end faq section -->

    <!-- 10. FOOTER -->
@push('scripts')
<style>
        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>



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

        .faq-card {
            background: white;
            border-color: #E5E7EB;
        }

        .faq-card.active .faq-toggle {
            background: #ECFDF5;
        }

        .faq-card.active .faq-icon {
            transform: rotate(45deg);
            transition: transform 0.3s ease;
        }

        .faq-toggle {
            transition: background 0.25s ease, color 0.25s ease;
        }

        .faq-panel {
            transition: max-height 0.45s cubic-bezier(0.22, 1, 0.36, 1), padding 0.25s ease;
        }

        .faq-panel.open {
            padding-top: 0;
            padding-bottom: 1.5rem;
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

        const faqToggles = document.querySelectorAll('.faq-toggle');

        function closeAllFaqs() {
            document.querySelectorAll('.faq-card').forEach(card => {
                card.classList.remove('active');
                const panel = card.querySelector('.faq-panel');
                const icon = card.querySelector('.faq-icon');
                panel.style.maxHeight = '0';
                panel.classList.remove('open');
                icon.textContent = '+';
                card.querySelector('.faq-toggle')?.setAttribute('aria-expanded', 'false');
            });
        }

        function openFaqCard(card) {
            const panel = card.querySelector('.faq-panel');
            const icon = card.querySelector('.faq-icon');
            const toggle = card.querySelector('.faq-toggle');
            card.classList.add('active');
            panel.classList.add('open');
            panel.style.maxHeight = panel.scrollHeight + 'px';
            icon.textContent = '−';
            toggle?.setAttribute('aria-expanded', 'true');
        }

        const firstFaqCard = document.querySelector('.faq-card');
        if (firstFaqCard) {
            closeAllFaqs();
            openFaqCard(firstFaqCard);
        }

        faqToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                const card = toggle.closest('.faq-card');
                const isOpen = card.classList.contains('active');

                closeAllFaqs();

                if (!isOpen) {
                    openFaqCard(card);
                }
            });
        });

        window.addEventListener('resize', () => {
            document.querySelectorAll('.faq-card.active .faq-panel').forEach(panel => {
                panel.style.maxHeight = panel.scrollHeight + 'px';
            });
        });
    </script>
@endpush

@endsection
