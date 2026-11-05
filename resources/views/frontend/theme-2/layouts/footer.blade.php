<footer id="contact" class="bg-brand-900 pt-20 pb-10 border-t-4 border-brand-600 text-brand-50">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Brand Info -->
                <div>
                    <a href="{{ url('/') }}" class="flex items-center gap-2 mb-6">
                       <img src="{{ settings()->light_logo_image }}" alt="{{ settings()->name }}" class="w-full h-12 rounded-lg group-hover:animate-spin-slow transition-transform">
                    </a>
                    <p class="text-brand-100/70 mb-6 leading-relaxed">{!! section(\App\Enums\SectionType::ABOUT,'about_us') !!}</p>
                    <div class="flex gap-4">
                        @foreach ($social_links as $social)
                            <a href="{{ @$social->link }}"
                                class="w-10 h-10 rounded-full bg-brand-800 flex items-center justify-center hover:bg-brand-600 hover:text-white transition-colors text-brand-100"
                                title="{{ $social->name }}"><i class="{{ $social->icon }}"></i></a>
                        @endforeach
                    </div>
                </div>

                <!-- Links 1 -->
                <div>
                    <h4 class="text-lg font-bold text-white mb-6">{{ __('levels.quick_links') }}</h4>
                    <ul class="space-y-3 text-brand-100/80">
                        <li><a href="{{ route('aboutus.index') }}" class="hover:text-white transition-colors">{{ __('levels.about_us') }}</a></li>
                        <li><a href="{{ url('/#services') }}" class="hover:text-white transition-colors">{{ __('levels.our_services') }}</a>
                        </li>
                        <li><a href="{{ url('/') }}#pricing" class="hover:text-white transition-colors">{{ __('levels.pricing_plans') }}</a></li>
                        <li><a href="{{ route('tracking.index') }}" class="hover:text-white transition-colors">{{ __('levels.track_parcel') }}</a>
                        </li>
                        <li><a href="{{ route('get.blogs') }}" class="hover:text-white transition-colors">{{ __('levels.blog') }}</a></li>
                    </ul>
                </div>

                <!-- Links 2 -->
                <div>
                    <h4 class="text-lg font-bold text-white mb-6">{{ __('levels.support') }}</h4>
                    <ul class="space-y-3 text-brand-100/80">
                        <li><a href="{{ route('contact.send.page') }}" class="hover:text-white transition-colors">{{ __('levels.contact') }}</a></li>
                        <li><a href="{{ route('termsof.condition.index') }}" class="hover:text-white transition-colors">{{ __('levels.terms_of_service') }}</a></li>
                        <li><a href="{{ route('privacy.policy.index') }}" class="hover:text-white transition-colors">{{ __('levels.privacy_policy') }}</a></li>
                        <li><a href="{{ route('get.faq.index') }}" class="hover:text-white transition-colors">{{ __('levels.faqs') }}</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-bold text-white mb-6">{{ __('levels.contact_us') }}</h4>
                    <ul class="space-y-4 text-brand-100/80">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-brand-400"></i>
                            <span>{{ settings()->address }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone-alt text-brand-400"></i>
                            <span>{{ settings()->phone }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-brand-400"></i>
                            <span>{{ settings()->email }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-brand-800 pt-8 text-center text-brand-100/50 text-sm">
                <p>{{ settings()->copyright }}</p>
            </div>
        </div>
    </footer>
