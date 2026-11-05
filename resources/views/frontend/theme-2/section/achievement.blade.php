<!-- 6. STATS SECTION -->
    <section class="py-20 bg-brand-900 relative overflow-hidden">
        <!-- Decor patterns -->
        <div class="absolute top-0 left-0 w-full h-full opacity-10"
            style="background-image: radial-gradient(#4ADE80 2px, transparent 2px); background-size: 30px 30px;"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-brand-600 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-brand-400 rounded-full blur-3xl opacity-20"></div>

        <div class="container mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-brand-800">
                <div class="p-4">
                    <div class="text-4xl md:text-6xl font-extrabold text-white mb-2">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'parcel_count') }}</div>
                    <p class="text-brand-100 font-medium tracking-wide">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'parcel_title') }}</p>
                </div>
                <div class="p-4">
                    <div class="text-4xl md:text-6xl font-extrabold text-white mb-2">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'merchant_count') }}</div>
                    <p class="text-brand-100 font-medium tracking-wide">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'merchant_title') }}</p>
                </div>
                <div class="p-4">
                    <div class="text-4xl md:text-6xl font-extrabold text-brand-400 mb-2">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'branch_count') }}</div>
                    <p class="text-brand-100 font-medium tracking-wide">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'branch_title') }}</p>
                </div>
                <div class="p-4">
                    <div class="text-4xl md:text-6xl font-extrabold text-white mb-2">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'reviews_count') }}</div>
                    <p class="text-brand-100 font-medium tracking-wide">{{ section(\App\Enums\SectionType::ACHIEVEMENT,'reviews_title') }}</p>
                </div>
            </div>
        </div>
    </section>
