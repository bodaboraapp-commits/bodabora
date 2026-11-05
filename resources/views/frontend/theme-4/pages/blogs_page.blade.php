@extends(active_theme() . '.layouts.master')
@section('title')
    {{ __('levels.blogs') }} | {{ settings()->name }}
@endsection
@section('content')
<!-- ========================================= -->
    <!-- BLOG -->
    <!-- ========================================= -->
    <main>
        <section id="blog" class="scroll-mt-24 pb-28">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <!-- Heading -->

                <div class="text-center max-w-3xl mx-auto">


                    <h2 class="mt-6 text-4xl lg:text-5xl font-black text-section-deep-text">
                        Our Latest Blog Post
                    </h2>
                    <p class="mt-6 text-section-light-text leading-8">
                        Discover the latest updates, delivery insights, shipping tips, and courier industry
                        news to help you stay informed and manage shipments more efficiently.
                    </p>

                </div>

                <!-- Grid -->

                <div class="grid lg:grid-cols-3 gap-8 mt-20">
                    @foreach ($blogs as $blog)
                        <!-- Card -->
                        <a href="{{ route('blog.details', $blog->id) }}"
                            class="block bg-white rounded-3xl overflow-hidden shadow-lg border border-border-green-100 gb-card-lift cursor-pointer">

                            <img src="{{ $blog->image }}"
                                class="h-60 w-full object-cover" alt="{{ $blog->title }}">

                            <div class="p-8">

                                <div class="flex items-center gap-5 text-sm text-blog-card-text">

                                    <span>
                                        <i class="fas fa-eye"></i> {{ $blog->views }}
                                    </span>

                                    <span>
                                        <i class="fas fa-calendar-alt"></i> {{ $blog->updated_at->format('d M Y') }}
                                    </span>

                                </div>

                                <h3
                                    class="mt-5 text-blog-card-text text-base font-medium leading-snug h-12 overflow-hidden line-clamp-2">
                                    {{ $blog->title }}
                                </h3>

                                <p class="mt-3 text-sm text-section-light-text leading-6 line-clamp-2">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 115) }}
                                </p>

                                <div class="flex items-center gap-4 mt-7">

                                    <div class="w-12 h-12 rounded-full bg-badge-bg text-badge-text flex items-center justify-center">
                                        <i class="fas fa-user"></i>
                                    </div>

                                    <div>

                                        <h4 class="font-bold">
                                            {{ @$blog->user->name }}
                                        </h4>

                                        <p class="text-sm text-blog-card-text">
                                            {{ __('levels.blogs') }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </a>
                    @endforeach
                </div>

                <div class="mt-12 text-center">
                    {{ $blogs->onEachSide(1)->links('frontend.partials.pagination') }}
                </div>

            </div>

        </section>
    </main>





    <!-- ========================================= -->
    <!-- FOOTER -->
    <!-- ========================================= -->
@push('scripts')
<!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@endsection