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
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-700">{{ section(\App\Enums\SectionType::GALLERY,'gallery_badge') ?: 'Gallery' }}</span>
            <h2 class="mt-6 text-3xl md:text-4xl font-extrabold text-slate-900">{{ section(\App\Enums\SectionType::GALLERY,'gallery_title') ?: 'Our Delivery Gallery' }}</h2>
            <p class="mt-4 text-base leading-8 text-slate-600">{{ section(\App\Enums\SectionType::GALLERY,'gallery_description') ?: 'Explore our successful deliveries, courier operations, and real shipment moments showcasing fast, secure, and reliable delivery services.' }}</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($galleryImages as $galleryImage)
                <div class="glass-panel rounded-3xl overflow-hidden shadow-soft hover-lift">
                    <img src="{{ $galleryImage }}" alt="{{ settings()->name }}" class="h-64 w-full object-cover">
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
