<div class="row"> 
    <div class="form-group col-md-4">
        <label for="title_1">{{ __('levels.first_title') }}</label> <span class="text-danger">*</span>
        <input id="title_1" type="text" name="data[title_1]"  placeholder="{{ __('levels.Enter_first_title') }}" autocomplete="off" class="form-control @error('title_1') is-invalid @enderror" value="{{old('title_1',@$section['title_1'])}}" required>
        @error('title_1')
            <small class="text-danger mt-2">{{ $message }}</small>
        @enderror
    </div> 
    <div class="form-group col-md-4">
        <label for="title_2">{{ __('levels.middle_title') }}</label> <span class="text-danger">*</span>
        <input id="title_2" type="text" name="data[title_2]"  placeholder="{{ __('levels.Enter_middle_title') }}" autocomplete="off" class="form-control @error('title_2') is-invalid @enderror" value="{{old('title_2',@$section['title_2'])}}" required>
        @error('title_2')
            <small class="text-danger mt-2">{{ $message }}</small>
        @enderror
    </div> 
    <div class="form-group col-md-4">
        <label for="title_3">{{ __('levels.last_title') }}</label> <span class="text-danger">*</span>
        <input id="title_3" type="text" name="data[title_3]"   placeholder="{{ __('levels.Enter_last_title') }}" autocomplete="off" class="form-control @error('title_3') is-invalid @enderror" value="{{old('title_3',@$section['title_3'])}}" required>
        @error('title_3')
            <small class="text-danger mt-2">{{ $message }}</small>
        @enderror
    </div>   
    @php
        $themeBanners = [
            1 => static_asset('frontend/images/banner.png'),
            2 => null,
            3 => static_asset('frontend/theme-3/image/frame-3.png'),
            4 => static_asset('frontend/theme-4/image/na_january_20.jpg'),
            5 => static_asset('frontend/theme-5/image/herobg.jpg'),
            6 => static_asset('frontend/images/banner.png'),
        ];
    @endphp
    @foreach($themeBanners as $themeNumber => $defaultBanner)
        @php
            $bannerKey = 'banner_theme_'.$themeNumber;
            $bannerPreview = @$section[$bannerKey.'_image'] ?: $defaultBanner;
        @endphp
        <div class="form-group col-md-4">
            <label for="{{ $bannerKey }}">{{ __('levels.banner') }} - Theme {{ $themeNumber }}</label>
            <input id="{{ $bannerKey }}" type="file" name="data[{{ $bannerKey }}]"  class="form-control @error($bannerKey) is-invalid @enderror">
            @error($bannerKey)
                <small class="text-danger mt-2">{{ $message }}</small>
            @enderror
            <div class="mt-3">
                @if($bannerPreview)
                    <img src="{{ $bannerPreview }}" width="30%" />
                @else
                    <small class="text-muted">Default illustration will be used.</small>
                @endif
            </div>
        </div>
    @endforeach
</div>