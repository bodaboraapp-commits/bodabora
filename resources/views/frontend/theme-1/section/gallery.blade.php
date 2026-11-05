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
<section class="container-fluid pb-5">
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h4 class="text-primary">{{ section(\App\Enums\SectionType::GALLERY,'gallery_badge') ?: 'Gallery' }}</h4>
                <h3 class="font-size-1-5rem display-6 font-weight-bold my-4">{{ section(\App\Enums\SectionType::GALLERY,'gallery_title') ?: 'Our Delivery Gallery' }}</h3>
                <p>{{ section(\App\Enums\SectionType::GALLERY,'gallery_description') ?: 'Explore our successful deliveries, courier operations, and real shipment moments showcasing fast, secure, and reliable delivery services.' }}</p>
            </div>
        </div>
        <div class="row g-4 mt-3">
            @foreach($galleryImages as $galleryImage)
                <div class="col-lg-4 col-sm-6">
                    <div class="overflow-hidden rounded">
                        <img src="{{ $galleryImage }}" alt="{{ settings()->name }}" class="w-100" style="height: 240px; object-fit: cover;">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
