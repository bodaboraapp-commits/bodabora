@php
    $bannerImage = section(\App\Enums\SectionType::BANNER,'banner_theme_6') ?: static_asset('frontend/images/banner.png');
@endphp
<section class="t5-hero" id="home">
    <div class="container t5-hero-content">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="t5-section-badge">{{ settings()->name }}</span>
                <h1 class="t5-hero-title mb-4">
                    <span>{{ section(\App\Enums\SectionType::BANNER,'title_1') }}</span>
                    <span class="highlight d-block">{{ section(\App\Enums\SectionType::BANNER,'title_2') }}</span>
                    <span>{{ section(\App\Enums\SectionType::BANNER,'title_3') }}</span>
                </h1>
                <p class="t5-hero-subtitle mb-4">{{ section(\App\Enums\SectionType::BANNER,'sub_title') }}</p>
                <form action="{{ route('tracking.index') }}" method="get" class="t5-tracking-form d-flex flex-column flex-sm-row gap-2">
                    <input type="text" class="form-control flex-grow-1" name="tracking_id" placeholder="{{ __('levels.enter_tracking_id') }}">
                    <button type="submit" class="btn btn-track">
                        <i class="fa fa-location-dot me-2"></i>{{ __('levels.track_now') }}
                    </button>
                </form>
            </div>
            <div class="col-lg-6 text-center">
                @if($bannerImage)
                    <img src="{{ $bannerImage }}" alt="{{ settings()->name }}" class="img-fluid t5-hero-image w-100">
                @endif
            </div>
        </div>
    </div>
</section>
