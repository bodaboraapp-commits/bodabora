<!-- ================= TERMS & CONDITIONS ================= -->
    <main class="bg-[#FAFAFA] py-20">
        <div class="max-w-6xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-[2rem] p-8 lg:p-12 border border-gray-100">
                <div class="max-w-3xl mx-auto">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-500">Terms & Conditions</p>
                    <h1 class="mt-4 text-4xl font-black text-[#0F3C2F]">Courier Services Terms</h1>
                    <p class="mt-6 text-gray-600 leading-8">These terms apply to all shipments booked through FastBox
                        courier services. Please review them before placing an order.</p>

                    <div class="mt-12 space-y-10">
                        <section>
                            <h2 class="text-2xl font-semibold text-[#13402D]">1. Service Agreement</h2>
                            <p class="mt-4 text-gray-600 leading-8">By using FastBox services, you agree to our shipping
                                terms, pricing, delivery timelines, and parcel handling policies. FastBox reserves the
                                right to refuse or suspend service for shipments that violate these terms.</p>
                        </section>

                        <section>
                            <h2 class="text-2xl font-semibold text-[#13402D]">2. Shipment Requirements</h2>
                            <ul class="mt-4 list-disc list-inside text-gray-600 leading-8 space-y-2">
                                <li>Customers are responsible for correct packaging, clear labeling, and accurate
                                    disclosure of shipment contents.</li>
                                <li>Restricted items such as hazardous materials, flammable liquids, and illegal goods
                                    are not accepted.</li>
                                <li>High-value items should be declared at booking and may require additional insurance
                                    coverage.</li>
                            </ul>
                        </section>

                        <section>
                            <h2 class="text-2xl font-semibold text-[#13402D]">3. Delivery and Transit</h2>
                            <ul class="mt-4 list-disc list-inside text-gray-600 leading-8 space-y-2">
                                <li>Delivery estimates depend on route, weather, customs, and other factors beyond our
                                    control.</li>
                                <li>FastBox is not liable for delays caused by third-party carriers, customs
                                    inspections, or government regulations.</li>
                                <li>Some deliveries may require recipient ID verification or signature upon receipt.
                                </li>
                            </ul>
                        </section>

                        <section>
                            <h2 class="text-2xl font-semibold text-[#13402D]">4. Liability and Claims</h2>
                            <ul class="mt-4 list-disc list-inside text-gray-600 leading-8 space-y-2">
                                <li>FastBox liability for loss, damage, or delay is limited to the declared shipment
                                    value or the maximum allowed by law.</li>
                                <li>Claims for damaged or missing items must be submitted within 7 days of delivery.
                                </li>
                                <li>Proof of value and packaging may be required when filing a claim.</li>
                            </ul>
                        </section>

                        <section>
                            <h2 class="text-2xl font-semibold text-[#13402D]">5. Customer Responsibilities</h2>
                            <ul class="mt-4 list-disc list-inside text-gray-600 leading-8 space-y-2">
                                <li>Provide accurate sender and recipient information, including phone number and
                                    address.</li>
                                <li>Any customs duties, taxes, or import fees are the responsibility of the sender or
                                    recipient as required by law.</li>
                                <li>Additional fees may apply for returns, failed deliveries, or changes requested after
                                    pickup.</li>
                            </ul>
                        </section>

                        <section>
                            <h2 class="text-2xl font-semibold text-[#13402D]">6. Changes and Cancellations</h2>
                            <p class="mt-4 text-gray-600 leading-8">Change or cancellation requests must be made before
                                pickup. FastBox may charge fees for late changes, rerouting, or cancellations.</p>
                        </section>

                        <section>
                            <h2 class="text-2xl font-semibold text-[#13402D]">7. Privacy and Data</h2>
                            <p class="mt-4 text-gray-600 leading-8">FastBox collects shipment and contact details to
                                process deliveries and communicate with customers. We handle personal data in accordance
                                with our privacy policy and applicable data protection laws.</p>
                        </section>
                    </div>
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

