<section class="t5-section t5-section-alt">
    <div class="container">
        <div class="text-center mb-5">
            <span class="t5-section-badge">{{ __('levels.happy_achievement') }}</span>
            <h2 class="t5-section-title">{{ __('levels.happy_achievement') }}</h2>
        </div>
        <div class="t5-achievement">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6">
                    <div class="t5-achievement-item">
                        <div class="icon"><i class="{{ section(\App\Enums\SectionType::ACHIEVEMENT,'branch_icon') }}"></i></div>
                        <h2><span class="odometer" data-count="{{ section(\App\Enums\SectionType::ACHIEVEMENT,'branch_count') }}">0</span><span class="odometer-position"></span></h2>
                        <p>{{ section(\App\Enums\SectionType::ACHIEVEMENT,'branch_title') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="t5-achievement-item">
                        <div class="icon"><i class="{{ section(\App\Enums\SectionType::ACHIEVEMENT,'parcel_icon') }}"></i></div>
                        <h2><span class="odometer" data-count="{{ section(\App\Enums\SectionType::ACHIEVEMENT,'parcel_count') }}">0</span><span class="odometer-position"></span></h2>
                        <p>{{ section(\App\Enums\SectionType::ACHIEVEMENT,'parcel_title') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="t5-achievement-item">
                        <div class="icon"><i class="{{ section(\App\Enums\SectionType::ACHIEVEMENT,'merchant_icon') }}"></i></div>
                        <h2><span class="odometer" data-count="{{ section(\App\Enums\SectionType::ACHIEVEMENT,'merchant_count') }}">0</span><span class="odometer-position"></span></h2>
                        <p>{{ section(\App\Enums\SectionType::ACHIEVEMENT,'merchant_title') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="t5-achievement-item">
                        <div class="icon"><i class="{{ section(\App\Enums\SectionType::ACHIEVEMENT,'reviews_icon') }}"></i></div>
                        <h2><span class="odometer" data-count="{{ section(\App\Enums\SectionType::ACHIEVEMENT,'reviews_count') }}">0</span><span class="odometer-position"></span></h2>
                        <p>{{ section(\App\Enums\SectionType::ACHIEVEMENT,'reviews_title') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
