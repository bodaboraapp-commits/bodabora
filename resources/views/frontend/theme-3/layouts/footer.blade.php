<footer class="bg-white pt-24 pb-10 border-t border-gray-100 relative overflow-hidden">

        <div class="absolute -bottom-20 -left-20 w-72 h-72 rounded-full bg-emerald-100 opacity-50 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid lg:grid-cols-4 gap-16">

                <!-- About -->
                <div>

                    <div class="flex items-center gap-3">
                        <img src="{{ settings()->light_logo_image }}" alt="{{ settings()->name }}" class="w-full h-16 object-contain">
                    </div>

                    <p class="mt-6 text-gray-500 leading-8">
                        {!! section(\App\Enums\SectionType::ABOUT,'about_us') !!}
                    </p>

                </div>

                <!-- Quick links -->
                <div>
                    <h3 class="font-black text-xl mb-6">
                        {{ __('levels.quick_links') }}
                    </h3>

                    <div class="space-y-4 text-gray-500">
                        <a href="{{ route('ev.invest.index') }}" class="block hover:text-emerald-500 transition">ebikeGO</a>
                        <a href="{{ route('agents.index') }}" class="block hover:text-emerald-500 transition">Agents</a>
                        <a href="{{ route('tracking.index') }}" class="block hover:text-emerald-500 transition">{{ __('levels.tracking') }}</a>
                        <a href="{{ url('/') }}#pricing" class="block hover:text-emerald-500 transition">{{ __('levels.pricing') }}</a>
                    </div>
                </div>
                <div>
                    <h3 class="font-black text-xl mb-6">
                        Information
                    </h3>

                    <div class="space-y-4 text-gray-500">
                        <a href="{{ route('contact.send.page') }}" class="block hover:text-emerald-500 transition">{{ __('levels.contact') }}</a>
                        <a href="{{ url('/#services') }}" class="block hover:text-emerald-500 transition">Services detail</a>
                        <a href="{{ route('get.faq.index') }}" class="block hover:text-emerald-500 transition">{{ __('levels.faqs') }}</a>
                        <a href="{{ route('termsof.condition.index') }}" class="block hover:text-emerald-500 transition">Terms &amp; Conditions</a>
                        <a href="{{ route('privacy.policy.index') }}" class="block hover:text-emerald-500 transition">Privacy Policy</a>
                    </div>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="font-black text-xl mb-6">
                        {{ __('levels.contact_us') }}
                    </h3>

                    <div class="space-y-5 text-gray-500">

                        <p>{{ settings()->phone }}</p>
                        <p>{{ settings()->email }}</p>
                        <p>{{ settings()->address }}</p>

                    </div>
                </div>



            </div>

            <!-- Bottom -->
            <div
                class="border-t border-gray-100 mt-16 pt-8 flex flex-col lg:flex-row justify-between items-center gap-5">

                <p class="text-gray-400 text-sm">
                    {{ settings()->copyright }}
                </p>

                <div class="flex gap-5 text-gray-400">
                    @foreach ($social_links as $social)
                        <a href="{{ @$social->link }}" class="hover:text-emerald-500 transition" title="{{ $social->name }}">
                            <i class="{{ $social->icon }}"></i>
                        </a>
                    @endforeach
                </div>

            </div>

        </div>

    </footer>
