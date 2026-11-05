@extends(active_theme() . '.layouts.master')
@section('title')
    {{ __('levels.blogs') }} | {{ settings()->name }}
@endsection
@section('content')
<main>
        <!-- Blog Section -->
        <section class="py-16 px-4 bg-white">
            <div class="container mx-auto">
                <!-- Section Header -->
                <div class="mb-12 text-center">
                    <h2 class="text-3xl sm:text-4xl font-bold text-blog-heading-text mb-3">Latest News & Blogs</h2>
                    <p class="text-section-light-text max-w-2xl mx-auto">Stay updated with the latest insights, tips,
                        and stories from the courier industry</p>
                </div>

                <!-- Blog Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($blogs as $blog)
                        <a href="{{ route('blog.details', $blog->id) }}"
                            class="block bg-white rounded-lg border border-border-green-100 overflow-hidden hover:shadow-lg transition-shadow duration-300 group">
                            <div class="aspect-video bg-gradient-to-br from-emerald-100 to-green-50 overflow-hidden">
                                <img src="{{ $blog->image }}" alt="{{ $blog->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="p-6">
                                <time class="text-xs font-semibold text-blog-date-text uppercase tracking-wider">{{ $blog->updated_at->format('d M Y') }}</time>
                                <h3
                                    class="text-lg font-bold text-blog-heading-text mt-2 group-hover:text-blog-heading-text-hover transition-colors duration-300">
                                    {{ $blog->title }}
                                </h3>
                                <p class="text-sm text-section-desc-text mt-3 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 120) }}</p>
                                <div class="mt-3 text-xs text-section-desc-text">
                                    <i class="fa-solid fa-user mr-1"></i>{{ @$blog->user->name }}
                                    <i class="fa-regular fa-eye ml-3 mr-1"></i>{{ $blog->views }}
                                </div>
                                <span
                                    class="inline-flex items-center mt-4 text-sm font-semibold text-emerald-600 hover:text-blog-more-text-hover transition-colors duration-300">
                                    Read More <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 text-center">
                    {{ $blogs->onEachSide(1)->links('frontend.partials.pagination') }}
                </div>
            </div>
        </section>
    </main>
@push('scripts')
<script>
        (function () {
            var toggle = document.getElementById("nav-toggle");
            var panel = document.getElementById("mobile-nav");

            if (!toggle || !panel) return;

            // toggle open/close
            toggle.addEventListener("click", function () {
                var open = panel.classList.toggle("hidden") === false;
                toggle.setAttribute("aria-expanded", open ? "true" : "false");
            });

            //  auto close on menu click
            panel.querySelectorAll("a, button").forEach(function (item) {
                item.addEventListener("click", function () {
                    if (!panel.classList.contains("hidden")) {
                        panel.classList.add("hidden");
                        toggle.setAttribute("aria-expanded", "false");
                    }
                });
            });

        })();
    </script>
@endpush

@endsection