@php
    $galleryImages = [];
    for ($i = 1; $i <= 7; $i++) {
        $galleryImage = section(\App\Enums\SectionType::GALLERY, 'gallery_image_'.$i);
        if($galleryImage) {
            $galleryImages[] = $galleryImage;
        }
    }
@endphp
@if(count($galleryImages))
<section class="t5-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="t5-section-badge">{{ section(\App\Enums\SectionType::GALLERY,'gallery_badge') }}</span>
            <h2 class="t5-section-title">{{ section(\App\Enums\SectionType::GALLERY,'gallery_title') }}</h2>
            <p class="t5-section-subtitle">{{ section(\App\Enums\SectionType::GALLERY,'gallery_description') }}</p>
        </div>
        <div class="row g-4">
            @foreach($galleryImages as $galleryImage)
                <div class="col-md-6 col-lg-4">
                    <div class="t5-card overflow-hidden p-0">
                        <img src="{{ $galleryImage }}" alt="{{ settings()->name }}" class="w-100" style="height: 240px; object-fit: cover;">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
