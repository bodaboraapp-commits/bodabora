<!-- ================= BLOG ================= -->
    <section class="py-24 bg-[#F5FBF7]">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center">
                <h2 class="text-4xl lg:text-5xl font-black">
                    From our blog
                </h2>

                <p class="mt-5 text-gray-500">
                    Tips, stories, and insights on delivery and logistics.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                @foreach ($blogs as $blog)
                    <a href="{{ route('blog.details', $blog->id) }}"
                        class="block bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition-shadow">
                        <div
                            class="relative h-48 bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center overflow-hidden">
                            <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <span
                                class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">{{ __('levels.blogs') }}</span>
                            <h3 class="text-lg font-bold mt-3 mb-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 120) }}</p>
                            <span class="text-emerald-600 font-semibold text-sm hover:text-emerald-700">Read More →</span>
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </section>
