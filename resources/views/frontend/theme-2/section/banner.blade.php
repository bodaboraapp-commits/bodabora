<!-- 2. HERO SECTION -->
@php
    $bannerImage = section(\App\Enums\SectionType::BANNER,'banner_theme_2');
@endphp
    <section id="top"
        class="relative pt-20 pb-32 lg:pt-32 lg:pb-40 overflow-hidden bg-gradient-to-br from-brand-50 via-white to-brand-100">
        <div class="blob-bg w-[500px] h-[500px] bg-brand-100 top-[-100px] right-[-100px]"></div>
        <div class="blob-bg w-[400px] h-[400px] bg-brand-50 bottom-[-50px] left-[-100px]"></div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left max-w-2xl mx-auto lg:mx-0">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-100 text-brand-800 font-medium text-sm mb-6 border border-brand-400/20">
                        <span class="relative flex h-3 w-3">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-brand-600"></span>
                        </span>
                        {{ settings()->name }}
                    </div>
                    <h1
                        class="text-5xl lg:text-6xl xl:text-7xl font-extrabold text-brand-900 leading-[1.1] mb-6 tracking-tight">
                        {{ section(\App\Enums\SectionType::BANNER,'title_1') }} <br> <span class="text-brand-600 relative">
                            {{ section(\App\Enums\SectionType::BANNER,'title_2') }}
                            <svg class="absolute w-full h-3 -bottom-1 left-0 text-brand-400 opacity-60"
                                viewBox="0 0 100 10" preserveAspectRatio="none">
                                <path d="M0 5 Q 50 15 100 5" stroke="currentColor" stroke-width="4" fill="none" />
                            </svg>
                        </span> <br> {{ section(\App\Enums\SectionType::BANNER,'title_3') }}
                    </h1>
                    <p class="text-lg lg:text-xl text-gray-600 mb-10 leading-relaxed">
                        {{ section(\App\Enums\SectionType::BANNER,'sub_title') }}
                    </p>
                    <div>

                        <a href="{{ route('tracking.index') }}"
                            class="w-full sm:w-auto text-center bg-white hover:bg-brand-50 text-brand-900 border border-brand-100 px-8 py-4 rounded-full font-bold text-lg transition-all shadow-sm hover:shadow-md">
                            {{ __('levels.track_now') }}
                        </a>
                    </div>

                    <div
                        class="mt-10 flex items-center justify-center lg:justify-start gap-4 text-sm text-gray-500 font-medium">
                        <div class="flex -space-x-3">
                            @foreach ($partners as $partner)
                                @if ($loop->iteration <= 3)
                                    <img class="w-10 h-10 rounded-full border-2 border-white object-cover"
                                        src="{{ $partner->image }}" alt="{{ $partner->name }}">
                                @endif
                            @endforeach
                            <div
                                class="w-10 h-10 rounded-full border-2 border-white bg-brand-100 text-brand-800 flex items-center justify-center font-bold text-xs">
                                {{ section(\App\Enums\SectionType::ACHIEVEMENT,'merchant_count') }}</div>
                        </div>
                        <p>{{ __('levels.trusted_by_happy_customers') }}</p>
                    </div>
                </div>

                <!-- Right Illustration -->
                <div class="relative hidden lg:block lg:ml-auto">
                    <div class="relative w-[500px] h-[500px] bike-float">
                        <!-- Abstract Background Shapes -->
                        <div class="absolute inset-0 bg-brand-100 rounded-full opacity-60 scale-90 blur-xl"></div>
                        <div class="absolute top-10 right-10 w-32 h-32 bg-brand-400 rounded-full opacity-20 blur-2xl">
                        </div>

                        <!-- Main Illustration SVG (Courier on Bike) -->
                        @if($bannerImage)
                            <img src="{{ $bannerImage }}" alt="{{ settings()->name }}"
                                class="absolute inset-0 w-full h-full object-contain drop-shadow-2xl">
                        @else
                        <svg class="absolute inset-0 w-full h-full drop-shadow-2xl" viewBox="0 0 500 500" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <!-- Clouds -->
                            <path class="cloud-move"
                                d="M120 150 C 120 130, 150 130, 160 140 C 170 120, 200 120, 210 140 C 230 140, 230 160, 210 160 L 120 160 Z"
                                fill="white" opacity="0.8" />
                            <path class="cloud-move" style="animation-delay: -7s; animation-duration: 20s;"
                                d="M350 100 C 350 90, 370 90, 380 95 C 390 85, 410 85, 415 95 C 430 95, 430 105, 415 105 L 350 105 Z"
                                fill="white" opacity="0.6" />

                            <!-- Road -->
                            <path d="M50 400 Q 250 420 450 400 L 450 420 Q 250 440 50 420 Z" fill="#DCFCE7" />
                            <path d="M100 410 L 140 410 M200 410 L 240 410 M300 410 L 340 410 M400 410 L 440 410"
                                stroke="#16A34A" stroke-width="4" stroke-linecap="round" opacity="0.5" />

                            <!-- Delivery Box (Back of bike) -->
                            <rect x="130" y="220" width="80" height="90" rx="8" fill="#16A34A" />
                            <path d="M130 240 L 210 240" stroke="#14532D" stroke-width="4" />
                            <rect x="150" y="250" width="40" height="40" rx="4" fill="#4ADE80" opacity="0.5" />
                            <path d="M160 270 L 180 270 M170 260 L 170 280" stroke="#14532D" stroke-width="4"
                                stroke-linecap="round" />

                            <!-- Bike Frame -->
                            <path d="M210 310 L 260 310 L 300 240 L 230 240 Z" fill="none" stroke="#14532D"
                                stroke-width="8" stroke-linejoin="round" />
                            <path d="M260 310 L 340 310 L 320 220" fill="none" stroke="#14532D" stroke-width="8"
                                stroke-linecap="round" stroke-linejoin="round" />

                            <!-- Wheels -->
                            <circle cx="210" cy="350" r="40" fill="none" stroke="#14532D" stroke-width="10" />
                            <circle cx="210" cy="350" r="32" fill="none" stroke="#DCFCE7" stroke-width="4" />
                            <circle cx="210" cy="350" r="8" fill="#16A34A" />

                            <circle cx="340" cy="350" r="40" fill="none" stroke="#14532D" stroke-width="10" />
                            <circle cx="340" cy="350" r="32" fill="none" stroke="#DCFCE7" stroke-width="4" />
                            <circle cx="340" cy="350" r="8" fill="#16A34A" />

                            <!-- Courier Body -->
                            <!-- Legs -->
                            <path d="M260 310 L 280 260 L 320 280" fill="none" stroke="#16A34A" stroke-width="14"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <!-- Torso -->
                            <path d="M280 260 L 310 180" fill="none" stroke="#16A34A" stroke-width="24"
                                stroke-linecap="round" />
                            <!-- Arm -->
                            <path d="M300 200 L 330 230 L 320 220" fill="none" stroke="#4ADE80" stroke-width="10"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <!-- Head/Helmet -->
                            <circle cx="320" cy="150" r="18" fill="#FCD34D" /> <!-- Face -->
                            <path d="M300 150 C 300 130, 340 130, 340 150 L 345 155 L 295 155 Z" fill="#14532D" />
                            <!-- Helmet -->

                            <!-- Speed Lines -->
                            <path d="M50 300 L 100 300 M30 330 L 70 330 M80 260 L 120 260" stroke="#4ADE80"
                                stroke-width="4" stroke-linecap="round" opacity="0.6" />
                        </svg>
                        @endif

                        <!-- Floating Notification Card -->
                        <div class="absolute top-20 -left-10 glass-panel p-4 rounded-2xl shadow-xl flex items-center gap-4 animate-bounce"
                            style="animation-duration: 3s;">
                            <div
                                class="w-10 h-10 rounded-full bg-brand-100 flex items-center justify-center text-brand-600">
                                <i class="fas fa-check"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-brand-900">{{ __('levels.package_delivered') }}</p>
                                <p class="text-xs text-gray-500">{{ __('levels.just_now') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
