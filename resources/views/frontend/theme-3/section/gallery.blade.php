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
<section class="py-20 gradient-soft">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex rounded-full bg-white px-4 py-2 text-sm font-semibold text-emerald-600 shadow-sm">{{ section(\App\Enums\SectionType::GALLERY,'gallery_badge') ?: 'Gallery' }}</span>
            <h2 class="mt-6 text-3xl lg:text-4xl font-extrabold">{{ section(\App\Enums\SectionType::GALLERY,'gallery_title') ?: 'Our Delivery Gallery' }}</h2>
            <p class="mt-4 text-gray-600 leading-8">{{ section(\App\Enums\SectionType::GALLERY,'gallery_description') ?: 'Explore our successful deliveries, courier operations, and real shipment moments showcasing fast, secure, and reliable delivery services.' }}</p>
        </div>

        <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($galleryImages as $galleryImage)
                <div class="rounded-2xl overflow-hidden bg-white shadow hover:shadow-lg transition">
                    <img src="{{ $galleryImage }}" alt="{{ settings()->name }}" class="h-64 w-full object-cover">
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
