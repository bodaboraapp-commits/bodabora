<div class="row">
    <div class="form-group col-md-4">
        <label for="gallery_badge">{{ __('Badge') }}</label> <span class="text-danger">*</span>
        <input id="gallery_badge" type="text" name="data[gallery_badge]" placeholder="{{ __('Badge') }}" autocomplete="off" class="form-control @error('gallery_badge') is-invalid @enderror" value="{{ old('gallery_badge', @$section['gallery_badge'] ?? 'Gallery') }}" required>
        @error('gallery_badge')
            <small class="text-danger mt-2">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="gallery_title">{{ __('Title') }}</label> <span class="text-danger">*</span>
        <input id="gallery_title" type="text" name="data[gallery_title]" placeholder="{{ __('Title') }}" autocomplete="off" class="form-control @error('gallery_title') is-invalid @enderror" value="{{ old('gallery_title', @$section['gallery_title'] ?? 'Our Delivery Gallery') }}" required>
        @error('gallery_title')
            <small class="text-danger mt-2">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label for="gallery_description">{{ __('Description') }}</label> <span class="text-danger">*</span>
        <textarea id="gallery_description" name="data[gallery_description]" placeholder="{{ __('Description') }}" class="form-control @error('gallery_description') is-invalid @enderror" rows="3" required>{{ old('gallery_description', @$section['gallery_description'] ?? 'Explore our successful deliveries, courier operations, and real shipment moments showcasing fast, secure, and reliable delivery services.') }}</textarea>
        @error('gallery_description')
            <small class="text-danger mt-2">{{ $message }}</small>
        @enderror
    </div>

    @for($imageNumber = 1; $imageNumber <= 7; $imageNumber++)
        @php
            $imageKey = 'gallery_image_'.$imageNumber;
            $imagePreview = @$section[$imageKey.'_image'];
        @endphp
        <div class="form-group col-md-4">
            <label for="{{ $imageKey }}">{{ __('Gallery Image') }} {{ $imageNumber }}</label>
            <input id="{{ $imageKey }}" type="file" name="data[{{ $imageKey }}]" class="form-control @error($imageKey) is-invalid @enderror">
            @error($imageKey)
                <small class="text-danger mt-2">{{ $message }}</small>
            @enderror
            <div class="mt-3">
                @if($imagePreview)
                    <img src="{{ $imagePreview }}" width="30%" />
                @endif
            </div>
        </div>
    @endfor
</div>
