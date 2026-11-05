<!-- terms and conditions section -->
    <main
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-brand-50 via-white to-brand-100 py-12 px-6">
        <div class="container mx-auto px-6 lg:px-12 py-10">
            <h1 class="text-3xl text-brand-400 font-semibold mb-6">{{ @$page->title ?: __('levels.terms_and_conditions') }}</h1>
            <div class="text-sm text-gray-500 text-left page-content">{!! @$page->description ?: section(\App\Enums\SectionType::ABOUT,'about_us') !!}</div>
        </div>
    </main>
    <!-- end terms and conditions section -->

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

