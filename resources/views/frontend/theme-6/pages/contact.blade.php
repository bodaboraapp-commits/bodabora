@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<section class="t5-page-hero">
    <div class="container">
        <h1 class="t5-page-title">{{ @$page->title }}</h1>
    </div>
</section>
<section class="t5-page-content">
    <div class="container">
        <div class="page-content mb-4">{!! $page->description !!}</div>
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-8">
                <div class="t5-contact-card">
                    <form action="{{ route('contact.message.send') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label fw-semibold">{{ __('levels.name') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ __('levels.enter_name') }}">
                                @error('name')<p class="text-danger small mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label fw-semibold">{{ __('levels.email') }} <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('levels.enter_email') }}">
                                @error('email')<p class="text-danger small mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">{{ __('levels.subject') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" placeholder="{{ __('levels.enter_subject') }}">
                                @error('subject')<p class="text-danger small mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">{{ __('levels.message') }} <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="message" rows="5" placeholder="{{ __('levels.enter_your_message') }}">{{ old('message') }}</textarea>
                                @error('message')<p class="text-danger small mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn t5-btn-primary">{{ __('levels.submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="t5-contact-info">
                    <h4 class="fw-bold mb-4">{{ __('levels.address') }}</h4>
                    <p><i class="fa fa-envelope me-2"></i>{{ settings()->email }}</p>
                    <p><i class="fa fa-phone me-2"></i>{{ settings()->phone }}</p>
                    <p class="mb-0"><i class="fa fa-location-dot me-2"></i>{{ settings()->address }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@if(section(\App\Enums\SectionType::MAP_LINK,'map_link'))
<section class="p-0">
    <iframe src="{{ section(\App\Enums\SectionType::MAP_LINK,'map_link') }}" width="100%" height="450" allowfullscreen loading="lazy" class="border-0"></iframe>
</section>
@endif
@endsection
