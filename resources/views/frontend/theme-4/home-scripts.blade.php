@push('scripts')
<!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        const tabs = document.querySelectorAll('.pricing-tab-btn');
        const contents = {
            'same-day': document.getElementById('same-day-content'),
            'next-day': document.getElementById('next-day-content'),
            'sub-city': document.getElementById('sub-city-content'),
            'outside-city': document.getElementById('outside-city-content')
        };

        function activateTab(tabId) {
            Object.entries(contents).forEach(([key, el]) => {
                if (!el) return;
                if (key === tabId) {
                    el.classList.remove('hidden');
                    el.classList.add('pricing-tab-fade-in');
                } else {
                    el.classList.add('hidden');
                    el.classList.remove('pricing-tab-fade-in');
                }
            });

            tabs.forEach(btn => {
                const id = btn.getAttribute('data-tab');
                if (id === tabId) {
                    btn.classList.remove('pricing-tab-inactive');
                    btn.classList.add('pricing-tab-active');
                } else {
                    btn.classList.remove('pricing-tab-active');
                    btn.classList.add('pricing-tab-inactive');
                }
            });
        }

        tabs.forEach(btn => {
            btn.addEventListener('click', () => activateTab(btn.getAttribute('data-tab')));
        });

        activateTab('same-day');
    </script>

    <script>
        // Scrollspy: highlight nav links (desktop + mobile) when sections enter viewport
        (function () {
            const sections = document.querySelectorAll('section[id]');
            if (!sections.length) return;

            const desktopNavLinks = document.querySelectorAll('nav a[href^="#"]');
            const mobileNavLinks = document.querySelectorAll('#mobile-nav a[href^="#"]');

            const removeActive = (links) => {
                links.forEach(a => {
                    a.classList.remove('bg-nav-bg', 'text-nav-active-text', 'border-active-border', 'border-b-2');
                });
            };

            const setActiveForId = (id) => {
                const selector = `nav a[href="#${id}"], #mobile-nav a[href="#${id}"]`;
                const matches = document.querySelectorAll(selector);
                removeActive(desktopNavLinks);
                removeActive(mobileNavLinks);
                matches.forEach(a => a.classList.add('bg-nav-bg', 'text-nav-active-text', 'border-active-border', 'border-b-2'));
            };

            // IntersectionObserver to watch sections
            const io = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        setActiveForId(entry.target.id);
                    }
                });
            }, { root: null, threshold: 0.55 });

            sections.forEach(s => io.observe(s));

            // Also update active immediately on nav link click (for smooth scroll targets)
            const allLinks = Array.from(desktopNavLinks).concat(Array.from(mobileNavLinks));
            allLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    const href = link.getAttribute('href') || '';
                    if (href.startsWith('#')) {
                        const id = href.slice(1);
                        setTimeout(() => setActiveForId(id), 50);
                    }
                });
            });
        })();
    </script>
@endpush
