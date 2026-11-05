@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<!-- contact section -->
    <main id="contact" class="py-20 bg-gradient-to-b from-brand-50 to-white">
        <div class="container mx-auto px-6 lg:px-12">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-brand-900 mb-4">{{ @$page->title }}</h2>
                <div class="text-lg text-gray-600 max-w-2xl mx-auto page-content">{!! $page->description !!}</div>
            </div>

            <!-- Contact Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                <!-- Left: Contact Form -->
                <div class="glass-panel rounded-2xl p-8 lg:p-10">
                    <h3 class="text-2xl font-bold text-brand-900 mb-8">{{ __('levels.send_us_message') }}</h3>
                    <form action="{{ route('contact.message.send') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('levels.full_name') }}</label>
                            <input type="text" id="name" name="name" placeholder="{{ __('levels.your_name') }}" value="{{ old('name') }}"
                                class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-400 focus:outline-none transition-all bg-white/50 backdrop-blur-sm">
                            @error('name')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('levels.email_address') }}</label>
                            <input type="email" id="email" name="email" placeholder="{{ __('levels.your_email') }}" value="{{ old('email') }}"
                                class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-400 focus:outline-none transition-all bg-white/50 backdrop-blur-sm">
                            @error('email')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject Field -->
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('levels.subject') }}</label>
                            <input type="text" id="subject" name="subject" placeholder="{{ __('levels.whats_this_about') }}" value="{{ old('subject') }}"
                                class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-400 focus:outline-none transition-all bg-white/50 backdrop-blur-sm">
                            @error('subject')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message Field -->
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('levels.message') }}</label>
                            <textarea id="message" name="message" rows="5" placeholder="{{ __('levels.your_message_here') }}" 
                                class="w-full px-4 py-3 rounded-xl border border-brand-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-400 focus:outline-none transition-all bg-white/50 backdrop-blur-sm resize-none">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-gradient-to-r from-brand-500 to-brand-600 hover:from-brand-600 hover:to-brand-700 text-white font-semibold py-3 rounded-xl transition-all shadow-soft hover:shadow-md transform hover:scale-105 duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>Send Message
                        </button>
                    </form>
                </div>

                <!-- Right: Contact Info -->
                <div class="space-y-8">
                    <!-- Office Address Card -->
                    <div class="glass-panel rounded-2xl p-8 hover-lift">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center flex-shrink-0 shadow-soft">
                                <i class="fas fa-map-marker-alt text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-brand-900 mb-1">{{ __('levels.our_location') }}</h4>
                                <p class="text-gray-600">{{ settings()->address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Number Card -->
                    <div class="glass-panel rounded-2xl p-8 hover-lift">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center flex-shrink-0 shadow-soft">
                                <i class="fas fa-phone-alt text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-brand-900 mb-1">{{ __('levels.phone_number') }}</h4>
                                <p class="text-gray-600">{{ settings()->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="glass-panel rounded-2xl p-8 hover-lift">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-400 to-brand-600 flex items-center justify-center flex-shrink-0 shadow-soft">
                                <i class="fas fa-envelope text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-brand-900 mb-1">{{ __('levels.email_address') }}</h4>
                                <p class="text-gray-600">{{ settings()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            @if(section(\App\Enums\SectionType::MAP_LINK,'map_link'))
            <div class="w-full rounded-2xl overflow-hidden shadow-lg hover-lift">
                <iframe 
                    src="{{ section(\App\Enums\SectionType::MAP_LINK,'map_link') }}"
                    width="100%" 
                    height="450" 
                    style="border:none;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            @endif
        </div>
    </main>
    <!-- end contact section -->

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

@endsection
