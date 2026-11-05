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

    <script>
        const tabs = document.querySelectorAll('.tab-btn');
        const contents = {
            'same-day': document.getElementById('same-day-content'),
            'next-day': document.getElementById('next-day-content'),
            'sub-city': document.getElementById('sub-city-content'),
            'outside-city': document.getElementById('outside-city-content')
        };

        function activateTab(tabId) {
            Object.values(contents).forEach(content => {
                if (content) content.classList.add('hidden');
            });
            if (contents[tabId]) contents[tabId].classList.remove('hidden');

            tabs.forEach(btn => {
                if (btn.getAttribute('data-tab') === tabId) {
                    btn.classList.replace('tab-inactive', 'tab-active');
                } else {
                    btn.classList.replace('tab-active', 'tab-inactive');
                }
            });
        }

        tabs.forEach(btn => {
            btn.addEventListener('click', () => {
                activateTab(btn.getAttribute('data-tab'));
            });
        });

        activateTab('same-day');
    </script>
    <script>
        // Get all testimonial cards
        const mainCards = document.querySelectorAll('.testimonial-card');
        const centerCard = document.querySelector('.main-card');
        const microCards = document.querySelectorAll('.micro-card');

        let currentZoomedCard = null;
        let currentZoomedMicro = null;

        // Function to reset main cards to default (center zoomed in, sides at normal scale)
        function resetToDefault() {
            mainCards.forEach(card => {
                card.classList.remove('zoom-in', 'zoom-out');
                card.style.zIndex = '';
            });

            // Center card gets zoom-in
            if (centerCard) {
                centerCard.classList.add('zoom-in');
                centerCard.style.zIndex = '50';
            }

            currentZoomedCard = centerCard;
        }

        // Function to zoom a specific card
        function zoomCard(card) {
            // If clicking the already zoomed card, reset to default
            if (currentZoomedCard === card) {
                resetToDefault();
                return;
            }

            // Remove all zoom classes
            mainCards.forEach(c => {
                c.classList.remove('zoom-in', 'zoom-out');
                c.style.zIndex = '';
            });

            // Add zoom-in to clicked card
            card.classList.add('zoom-in');
            card.style.zIndex = '50';

            // Add zoom-out to other cards
            mainCards.forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.add('zoom-out');
                }
            });

            currentZoomedCard = card;
        }

        // Micro cards functions
        function resetAllMicroCards() {
            microCards.forEach(micro => {
                micro.classList.remove('micro-zoom-in', 'micro-zoom-out');
            });
        }

        function zoomMicroCard(microCard) {
            if (currentZoomedMicro === microCard) {
                resetAllMicroCards();
                currentZoomedMicro = null;
                return;
            }

            resetAllMicroCards();
            microCard.classList.add('micro-zoom-in');

            microCards.forEach(other => {
                if (other !== microCard) {
                    other.classList.add('micro-zoom-out');
                }
            });

            currentZoomedMicro = microCard;
        }

        // Add click listeners to main cards
        mainCards.forEach(card => {
            card.addEventListener('click', (e) => {
                e.stopPropagation();
                zoomCard(card);
                // Reset micro cards when main card is clicked
                if (currentZoomedMicro !== null) {
                    resetAllMicroCards();
                    currentZoomedMicro = null;
                }
            });
        });

        // Add click listeners to micro cards
        microCards.forEach(micro => {
            micro.addEventListener('click', (e) => {
                e.stopPropagation();
                zoomMicroCard(micro);
                // When micro clicked, reset main to default (center zoomed)
                if (currentZoomedCard !== centerCard) {
                    resetToDefault();
                }
            });
        });

        // Click outside resets everything
        document.body.addEventListener('click', (e) => {
            let isInsideCard = false;
            let isInsideMicro = false;

            mainCards.forEach(card => {
                if (card.contains(e.target)) isInsideCard = true;
            });
            microCards.forEach(micro => {
                if (micro.contains(e.target)) isInsideMicro = true;
            });

            if (!isInsideCard && !isInsideMicro) {
                resetToDefault();
                resetAllMicroCards();
                currentZoomedMicro = null;
            }
        });

        // Initialize: center card zoomed in
        resetToDefault();
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
