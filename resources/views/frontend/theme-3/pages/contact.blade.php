@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<!-- contact section -->
    <main class="py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Form -->
                <div>
                    <div class="bg-white rounded-2xl p-8 shadow">
                        <h2 class="text-2xl font-bold mb-4">{{ @$page->title }}</h2>
                        <div class="text-gray-600 mb-6 page-content">{!! $page->description !!}</div>

                        <form action="{{ route('contact.message.send') }}" method="post" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <input type="text" name="name" required placeholder="{{ __('levels.full_name') }}" value="{{ old('name') }}"
                                    class="w-full h-12 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-400" />
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <input type="email" name="email" required placeholder="{{ __('levels.enter_email') }}" value="{{ old('email') }}"
                                    class="w-full h-12 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-400" />
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <input type="text" name="subject" placeholder="{{ __('levels.enter_subject') }}" value="{{ old('subject') }}"
                                    class="w-full h-12 px-4 rounded-xl border border-gray-200 outline-none focus:border-emerald-400" />
                                    @error('subject')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <textarea name="message" rows="5" placeholder="{{ __('levels.your_message') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:border-emerald-400">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit"
                                class="mt-2 w-full h-12 rounded-2xl bg-emerald-400 hover:bg-emerald-500 text-white font-semibold">Send
                                Message</button>
                        </form>
                    </div>
                </div>

                <!-- Contact details -->
                <div>
                    <div class="bg-white rounded-2xl p-8 shadow">
                        <h3 class="text-xl font-bold">{{ __('levels.contact_information') }}</h3>
                        <div class="mt-4 space-y-3 text-gray-600">
                            <div>
                                <strong>{{ __('levels.address') }}</strong>
                                <p class="text-sm">{{ settings()->address }}</p>
                            </div>

                            <div>
                                <strong>{{ __('levels.phone') }}</strong>
                                <p class="text-sm">{{ settings()->phone }}</p>
                            </div>

                            <div>
                                <strong>{{ __('levels.email') }}</strong>
                                <p class="text-sm">{{ settings()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map below -->
            @if(section(\App\Enums\SectionType::MAP_LINK,'map_link'))
            <div class="mt-8">
                <div class="bg-white rounded-2xl overflow-hidden shadow">
                    <iframe src="{{ section(\App\Enums\SectionType::MAP_LINK,'map_link') }}" width="100%"
                        height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            @endif
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

@endsection
