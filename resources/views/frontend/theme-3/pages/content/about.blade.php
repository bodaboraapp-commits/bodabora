<!-- about section -->
    <main class="py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">About FastBox</h1>
                    <p class="mt-6 text-gray-600 leading-relaxed">FastBox is a modern courier platform focused on fast,
                        reliable, and affordable deliveries across the country. We combine real-time tracking, clear
                        pricing,
                        and a friendly support team to make shipping worry-free for businesses and individuals alike.
                    </p>

                    <div class="mt-8 grid sm:grid-cols-2 gap-4">
                        <div class="p-6 bg-white rounded-xl shadow">
                            <h3 class="font-semibold">Our Mission</h3>
                            <p class="mt-2 text-sm text-gray-500">Deliver packages quickly and safely while keeping
                                customers
                                informed every step of the way.</p>
                        </div>

                        <div class="p-6 bg-white rounded-xl shadow">
                            <h3 class="font-semibold">Our Values</h3>
                            <p class="mt-2 text-sm text-gray-500">Transparency, reliability, and customer-first service
                                guide
                                everything we do.</p>
                        </div>
                    </div>

                    <a href="{{ route('tracking.index') }}"
                        class="inline-block mt-8 rounded-2xl bg-emerald-400 hover:bg-emerald-500 text-white px-6 py-3 font-semibold">Track
                        a shipment</a>
                </div>

                <div>
                    <div class="bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-6 shadow-lg">
                        <img src="{{ static_asset('frontend/theme-3/image/hero-about.png') }}" alt="FastBox team"
                            class="w-full rounded-lg object-cover h-64 lg:h-80" onerror="this.style.opacity=0.4" />
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- about section -->



    <!-- ================= FOOTER ================= -->
@push('scripts')
<style>
        .active-tab {
            border: 2px solid #10b981;
            transform: translateX(6px);
        }
    </style>

    <script>
        const testimonials = [
            {
                name: "Adam Smith",
                role: "Business Owner",
                review: "FastBox helped us scale our delivery operations smoothly. Their fast support and secure shipping made a huge difference for our business."
            },
            {
                name: "Sofia Caroline",
                role: "Fashion Seller",
                review: "I love the real-time tracking and quick delivery service. My customers now receive products faster and trust my brand more."
            },
            {
                name: "Martin Motcast",
                role: "Web Developer",
                review: "FastBox transformed our delivery system completely. Shipments are now faster, safer, and customers love the live tracking feature."
            }
        ];

        function showReview(index) {

            document.getElementById("reviewText").innerText = testimonials[index].review;
            document.getElementById("reviewName").innerText = testimonials[index].name;
            document.getElementById("reviewRole").innerText = testimonials[index].role;

            // Active Tab
            const tabs = document.querySelectorAll(".testimonial-tab");

            tabs.forEach(tab => {
                tab.classList.remove("active-tab");
            });

            tabs[index].classList.add("active-tab");
        }
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

        const tabs = document.querySelectorAll('.tab-btn');
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
                    el.classList.add('animate-fade-in');
                } else {
                    el.classList.add('hidden');
                    el.classList.remove('animate-fade-in');
                }
            });

            tabs.forEach(btn => {
                const id = btn.getAttribute('data-tab');
                if (id === tabId) {
                    btn.classList.remove('tab-inactive');
                    btn.classList.add('tab-active');
                    btn.setAttribute('aria-selected', 'true');
                } else {
                    btn.classList.remove('tab-active');
                    btn.classList.add('tab-inactive');
                    btn.setAttribute('aria-selected', 'false');
                }
            });
        }

        tabs.forEach(btn => {
            btn.addEventListener('click', () => activateTab(btn.getAttribute('data-tab')));
        });

        activateTab('same-day');
    </script>
@endpush

