<section id="pricing" class="t5-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="t5-section-badge">{{ __('levels.pricing') }}</span>
            <h2 class="t5-section-title">{{ settings()->name }} {{ __('levels.pricing') }}</h2>
        </div>

        <ul class="nav nav-pills t5-pricing-tabs justify-content-center flex-wrap mb-5" id="t5PricingTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="t5-same-day-tab" data-bs-toggle="pill" data-bs-target="#t5-same-day" type="button" role="tab">{{ __('levels.same_day') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="t5-next-day-tab" data-bs-toggle="pill" data-bs-target="#t5-next-day" type="button" role="tab">{{ __('levels.next_day') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="t5-sub-city-tab" data-bs-toggle="pill" data-bs-target="#t5-sub-city" type="button" role="tab">{{ __('levels.sub_city') }}</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="t5-outside-tab" data-bs-toggle="pill" data-bs-target="#t5-outside" type="button" role="tab">{{ __('levels.outside_city') }}</button>
            </li>
        </ul>

        <div class="tab-content" id="t5PricingTabContent">
            <div class="tab-pane fade show active" id="t5-same-day" role="tabpanel">
                <div class="row g-3 justify-content-center">
                    @foreach ($pricing as $samedayPrice)
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="t5-price-card">
                                <p class="small text-muted mb-0">{{ __('levels.up_to') }} {{ $samedayPrice->weight }}</p>
                                <small class="text-muted">({{ @$samedayPrice->category->title }})</small>
                                <h3>{{ settings()->currency }} {{ $samedayPrice->same_day }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="t5-next-day" role="tabpanel">
                <div class="row g-3 justify-content-center">
                    @foreach ($pricing as $nextdayPrice)
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="t5-price-card">
                                <p class="small text-muted mb-0">{{ __('levels.up_to') }} {{ $nextdayPrice->weight }}</p>
                                <small class="text-muted">({{ @$nextdayPrice->category->title }})</small>
                                <h3>{{ settings()->currency }} {{ $nextdayPrice->next_day }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="t5-sub-city" role="tabpanel">
                <div class="row g-3 justify-content-center">
                    @foreach ($pricing as $subcityPrice)
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="t5-price-card">
                                <p class="small text-muted mb-0">{{ __('levels.up_to') }} {{ $subcityPrice->weight }}</p>
                                <small class="text-muted">({{ @$subcityPrice->category->title }})</small>
                                <h3>{{ settings()->currency }} {{ $subcityPrice->sub_city }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="t5-outside" role="tabpanel">
                <div class="row g-3 justify-content-center">
                    @foreach ($pricing as $outsidecityPrice)
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="t5-price-card">
                                <p class="small text-muted mb-0">{{ __('levels.up_to') }} {{ $outsidecityPrice->weight }}</p>
                                <small class="text-muted">({{ @$outsidecityPrice->category->title }})</small>
                                <h3>{{ settings()->currency }} {{ $outsidecityPrice->outside_city }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
