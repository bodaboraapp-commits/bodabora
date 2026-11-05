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
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl text-center mx-auto">
            <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-badge-bg/20 border border-badge-border text-badge-border text-sm font-semibold backdrop-blur">
                <i class="fa-solid fa-images"></i>
                {{ section(\App\Enums\SectionType::GALLERY,'gallery_badge') ?: 'Gallery' }}
            </span>
            <h2 class="mt-6 text-3xl sm:text-4xl font-extrabold text-section-heading-text tracking-tight">
                {{ section(\App\Enums\SectionType::GALLERY,'gallery_title') ?: 'Our Delivery Gallery' }}
            </h2>
            <p class="mt-4 text-section-desc-text leading-relaxed">
                {{ section(\App\Enums\SectionType::GALLERY,'gallery_description') ?: 'Explore our successful deliveries, courier operations, and real shipment moments showcasing fast, secure, and reliable delivery services.' }}
            </p>
        </div>

        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($galleryImages as $galleryImage)
                <div class="rounded-3xl border border-border-green-100 bg-white p-2 shadow-sm overflow-hidden">
                    <img src="{{ $galleryImage }}" alt="{{ settings()->name }}" class="h-64 w-full rounded-2xl object-cover">
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
