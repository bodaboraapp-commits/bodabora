<!--  blog -->
    <section class="py-24 bg-brand-50">
        <div class="container mx-auto px-6 lg:px-12">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-extrabold text-brand-900 mb-6 tracking-tight">Latest from Our Blog
                </h2>
                <p class="text-lg text-gray-600">Stay updated with the latest news and insights from our team of
                    logistics experts.</p>
            </div>

            <!-- Blog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($blogs as $blog)
                    <a href="{{ route('blog.details', $blog->id) }}"
                        class="block glass-panel rounded-2xl overflow-hidden hover-lift group">
                        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-brand-100 to-brand-200">
                            <img src="{{ $blog->image }}"
                                alt="{{ $blog->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="inline-block bg-brand-600 text-white text-xs font-bold px-3 py-1 rounded-full">{{ __('levels.blogs') }}</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-brand-900 mb-2 line-clamp-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 120) }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                <span><i class="fas fa-user-circle mr-1"></i>{{ @$blog->user->name }}</span>
                                <span><i class="fas fa-calendar-alt mr-1"></i>{{ $blog->updated_at->format('d M Y') }}</span>
                            </div>
                            <span
                                class="inline-flex items-center gap-2 text-brand-600 font-semibold hover:text-brand-700 transition-colors">
                                Read More <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </section>
