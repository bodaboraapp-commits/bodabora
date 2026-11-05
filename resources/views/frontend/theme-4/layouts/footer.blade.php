<footer class="pt-10 pb-10 border-t border-border-green-100">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid lg:grid-cols-5 gap-16">

                <!-- Logo -->

                <div class="lg:col-span-2">

                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 group">
                        <img src="{{ settings()->light_logo_image }}" alt="{{ settings()->name }}"
                            class="h-12 rounded-lg group-hover:animate-spin-slow transition-transform">
                    </a>

                    <p class="mt-6 text-footer-desc-text leading-8 max-w-md">
                        {!! section(\App\Enums\SectionType::ABOUT,'about_us') !!}
                    </p>

                </div>

                <!-- Links -->

                <div>

                    <h3 class="font-black text-xl">
                        {{ __('levels.services') }}
                    </h3>

                    <div class="space-y-4 mt-6 text-footer-link-text">

                        @foreach ($take_services as $footer_service)
                            <a href="{{ route('service.details', $footer_service->id) }}" class="block hover:text-green-600 transition">
                                {{ $footer_service->title }}
                            </a>
                        @endforeach

    

                    </div>

                </div>

                <!-- Links -->

                <div>

                    <h3 class="font-black text-xl">
                        Information
                    </h3>

                    <div class="space-y-4 mt-6 text-footer-link-text">

                        <a href="{{ route('aboutus.index') }}" class="block hover:text-green-600 transition">
                            {{ __('levels.about') }}
                        </a>

                        <a href="{{ route('get.blogs') }}" class="block hover:text-green-600 transition">
                            {{ __('levels.blog') }}
                        </a>

                        <a href="{{ route('get.faq.index') }}" class="block hover:text-green-600 transition">
                            FAQ
                        </a>

                        <a href="{{ route('contact.send.page') }}" class="block hover:text-green-600 transition">
                            {{ __('levels.contact') }}
                        </a>
                        <a href="{{ route('termsof.condition.index') }}" class="block hover:text-green-600 transition">
                            terms and conditions
                        </a>

                        <a href="{{ route('privacy.policy.index') }}" class="block hover:text-green-600 transition">
                            privacy and policy
                        </a>
                    </div>

                </div>

                <!-- Contact -->

                <div>

                    <h3 class="font-black text-xl">
                        {{ __('levels.contact') }}
                    </h3>

                    <div class="space-y-4 mt-6 text-footer-desc-text">

                        <p>
                            {{ settings()->address }}
                        </p>

                        <p>
                            {{ settings()->phone }}
                        </p>

                        <p>
                            {{ settings()->email }}
                        </p>

                    </div>

                </div>

            </div>

            <!-- Bottom -->

            <div
                class="border-t border-border-green-100 mt-16 pt-8 flex flex-col lg:flex-row justify-between gap-5 items-center">

                <p class="text-footer-copyright-text text-sm">
                    {{ settings()->copyright }}
                </p>

                <div class="flex gap-5 text-footer-copyright-text">

                    @foreach ($social_links as $social)
                        <a href="{{ @$social->link }}"
                            class="hover:text-footer-copyright-text-hover transition text-xl duration-300 transform"
                            title="{{ $social->name }}">
                            <i class="{{ $social->icon }}"></i>
                        </a>
                    @endforeach

                </div>

            </div>

        </div>

    </footer>
