<footer class="t5-footer">
    <div class="container">
        <div class="row g-4 py-5">
            <div class="col-lg-4 col-md-6">
                <a href="{{ url('/') }}">
                    <img src="{{ settings()->light_logo_image }}" alt="{{ settings()->name }}" width="180" class="mb-3">
                </a>
                <p class="small opacity-75">{!! section(\App\Enums\SectionType::ABOUT,'about_us') !!}</p>
                <h4 class="mt-4">{{ __('levels.download_app') }}</h4>
                <div class="d-flex gap-3 mt-3">
                    <a href="{{ section(\App\Enums\SectionType::APP_LINK,'playstore_link') }}" title="{{ __('levels.play_store') }}">
                        <i class="{{ section(\App\Enums\SectionType::APP_LINK,'playstore_icon') }} fa-2x"></i>
                    </a>
                    <a href="{{ section(\App\Enums\SectionType::APP_LINK,'ios_link') }}" title="{{ __('levels.ios_store') }}">
                        <i class="{{ section(\App\Enums\SectionType::APP_LINK,'ios_icon') }} fa-2x"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h4>{{ __('levels.available_services') }}</h4>
                <ul class="list-unstyled t5-footer-list">
                    @foreach ($take_services as $footer_service)
                        <li><a href="{{ route('service.details', $footer_service->id) }}">{{ $footer_service->title }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-2 col-md-6">
                <h4>{{ __('levels.about') }}</h4>
                <ul class="list-unstyled t5-footer-list">
                    <li><a href="{{ route('get.faq.index') }}">{{ __('levels.faq') }}</a></li>
                    <li><a href="{{ route('aboutus.index') }}">{{ __('levels.about_us') }}</a></li>
                    <li><a href="{{ route('contact.send.page') }}">{{ __('levels.contact_us') }}</a></li>
                    <li><a href="{{ route('privacy.policy.index') }}">{{ __('levels.privacy_policy') }}</a></li>
                    <li><a href="{{ route('termsof.condition.index') }}">{{ __('levels.terms_of_use') }}</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h4>{{ section(\App\Enums\SectionType::SUBSCRIBE,'subscribe_title') }}</h4>
                <p class="small opacity-75">{{ section(\App\Enums\SectionType::SUBSCRIBE,'subscribe_description') }}</p>
                <form action="{{ route('subscribe.store') }}" method="post" class="mt-3">
                    @csrf
                    <div class="t5-subscribe-form d-flex">
                        <input type="email" class="form-control" placeholder="{{ __('placeholder.enter_email') }}" name="email" value="{{ old('email') }}" required>
                        <button type="submit" class="btn t5-subscribe-form btn-subscribe"><i class="fa fa-paper-plane"></i></button>
                    </div>
                    @error('email')
                        <p class="text-danger small mt-2">{{ $message }}</p>
                    @enderror
                </form>

                <h4 class="mt-4">{{ __('levels.social') }}</h4>
                <div class="d-flex flex-wrap gap-3 mt-2">
                    @foreach ($social_links as $social)
                        <a href="{{ $social->link }}" title="{{ $social->name }}"><i class="{{ $social->icon }} fa-lg"></i></a>
                    @endforeach
                </div>
            </div>
        </div>

        <ul class="list-unstyled d-flex flex-wrap justify-content-center gap-2 t5-lang-list pb-3">
            <li><a href="{{ route('setlocalization','en') }}"><i class="flag-icon flag-icon-us"></i> {{ __('levels.english') }}</a></li>
            <li><a href="{{ route('setlocalization','bn') }}"><i class="flag-icon flag-icon-bd"></i> {{ __('levels.bangla') }}</a></li>
            <li><a href="{{ route('setlocalization','in') }}"><i class="flag-icon flag-icon-in"></i> {{ __('levels.hindi') }}</a></li>
            <li><a href="{{ route('setlocalization','ar') }}"><i class="flag-icon flag-icon-sa"></i> {{ __('levels.arabic') }}</a></li>
            <li><a href="{{ route('setlocalization','tr') }}"><i class="flag-icon flag-icon-tr"></i> {{ __('levels.turkish') }}</a></li>
            <li><a href="{{ route('setlocalization','fr') }}"><i class="flag-icon flag-icon-fr"></i> {{ __('levels.franch') }}</a></li>
            <li><a href="{{ route('setlocalization','es') }}"><i class="flag-icon flag-icon-es"></i> {{ __('levels.spanish') }}</a></li>
            <li><a href="{{ route('setlocalization','zh') }}"><i class="flag-icon flag-icon-cn"></i> {{ __('levels.chinese') }}</a></li>
        </ul>

        <div class="t5-footer-bottom">
            <p class="mb-0">{{ settings()->copyright }}</p>
        </div>
    </div>
</footer>
