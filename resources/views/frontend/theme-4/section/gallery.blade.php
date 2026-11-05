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
<!-- GALLERY -->
    <!-- ========================================= -->
    <section class="pb-28 overflow-hidden">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Heading -->
            <div class="text-center max-w-3xl mx-auto">

                <span
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-badge-bg text-badge-text text-sm font-semibold">
                    {{ section(\App\Enums\SectionType::GALLERY,'gallery_badge') ?: 'Gallery' }}
                </span>

                <h2 class="mt-6 text-4xl lg:text-5xl font-black text-section-deep-text">
                    {{ section(\App\Enums\SectionType::GALLERY,'gallery_title') ?: 'Our Delivery Gallery' }}
                </h2>
                <p class="mt-6 text-section-light-text leading-8">
                    {{ section(\App\Enums\SectionType::GALLERY,'gallery_description') ?: 'Explore our successful deliveries, courier operations, and real shipment moments showcasing fast, secure, and reliable delivery services.' }}
                </p>
            </div>

            <!-- Gallery -->
            <div class="mt-20 space-y-7">

                <!-- First Row -->
                <div class="grid grid-cols-1 lg:grid-cols-10 gap-7">

                    <!-- 70% -->
                    <div class="lg:col-span-7 group overflow-hidden rounded-[20px]">
                        <img src="{{ $galleryImages[0 % count($galleryImages)] }}"
                            class="h-72 w-full object-cover transition duration-700 group-hover:scale-110" alt="{{ settings()->name }}">
                    </div>

                    <!-- 30% -->
                    <div class="lg:col-span-3 group overflow-hidden rounded-[20px]">
                        <img src="{{ $galleryImages[1 % count($galleryImages)] }}"
                            class="h-72 w-full object-cover transition duration-700 group-hover:scale-110" alt="{{ settings()->name }}">
                    </div>

                </div>

                <!-- Second Row -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">

                    <div class="group overflow-hidden rounded-[20px]">
                        <img src="{{ $galleryImages[2 % count($galleryImages)] }}"
                            class="h-60 w-full object-cover transition duration-700 group-hover:scale-110" alt="{{ settings()->name }}">
                    </div>

                    <div class="group overflow-hidden rounded-[20px]">
                        <img src="{{ $galleryImages[3 % count($galleryImages)] }}"
                            class="h-60 w-full object-cover transition duration-700 group-hover:scale-110" alt="{{ settings()->name }}">
                    </div>

                    <div class="group overflow-hidden rounded-[20px]">
                        <img src="{{ $galleryImages[4 % count($galleryImages)] }}"
                            class="h-60 w-full object-cover transition duration-700 group-hover:scale-110" alt="{{ settings()->name }}">
                    </div>

                </div>

                <!-- Third Row -->
                <div class="grid grid-cols-1 lg:grid-cols-10 gap-7">

                    <!-- 30% -->
                    <div class="lg:col-span-3 group overflow-hidden rounded-[20px]">
                        <img src="{{ $galleryImages[5 % count($galleryImages)] }}"
                            class="h-52 w-full object-cover transition duration-700 group-hover:scale-110" alt="{{ settings()->name }}">
                    </div>

                    <!-- 70% -->
                    <div class="lg:col-span-7 group overflow-hidden rounded-[20px]">
                        <img src="{{ $galleryImages[6 % count($galleryImages)] }}"
                            class="h-52 w-full object-cover transition duration-700 group-hover:scale-110" alt="{{ settings()->name }}">
                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ========================================= -->
@endif
