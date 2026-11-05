@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$blog->title }} | {{ settings()->name }}
@endsection
@section('content')
<!-- ========================================= -->
    <!-- BLOG detail -->
    <!-- ========================================= -->
    <main>
        <section id="blog" class="scroll-mt-24 py-28">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="text-center max-w-3xl mx-auto">
                    <p class="text-sm uppercase tracking-[0.35em] font-semibold text-green-600">Blog Detail</p>
                    <h2 class="mt-6 text-4xl lg:text-5xl font-black text-section-deep-text">{{ @$blog->title }}</h2>
                    <p class="mt-6 text-section-light-text leading-8">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 170) }}</p>
                </div>

                <div class="mt-20 grid gap-10 lg:grid-cols-[2fr_1fr]">

                    <!-- Blog detail -->
                    <article class="space-y-10">
                        <div class="rounded-[2rem] overflow-hidden bg-white shadow-xl border border-border-green-100">
                            <img src="{{ $blog->image }}"
                                class="w-full h-96 object-cover" alt="{{ $blog->title }}">

                            <div class="p-10">
                                <div
                                    class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-sm text-blog-card-text">
                                    <span class="font-medium">By {{ @$blog->user->name }}</span>
                                    <span>{{ $blog->updated_at->format('d M Y h:i A') }}</span>
                                    <span><i class="fas fa-eye"></i> {{ $blog->views }}</span>
                                </div>

                                <h3 class="mt-6 text-3xl font-black text-section-text">{{ @$blog->title }}</h3>

                                <div class="mt-8 grid gap-6 text-body-text leading-8">
                                    {!! $blog->description !!}
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Sidebar menu -->
                    <aside class="space-y-8">
                        <div class="rounded-[2rem] bg-white p-8 shadow-xl border border-border-green-100">
                            <h4 class="text-xl font-black text-section-text">{{ __('levels.latest_blogs') }}</h4>
                            <div class="mt-6 space-y-4">
                                @foreach ($latest_blogs as $latest_blog)
                                    <a href="{{ route('blog.details', $latest_blog->id) }}"
                                        class="block rounded-3xl border border-border-green-100 bg-slate-50 px-5 py-4 hover:bg-green-50 transition">
                                        <span class="font-semibold text-section-heading-text">{{ \Illuminate\Support\Str::limit($latest_blog->title, 55) }}</span>
                                        <p class="text-sm text-blog-card-text mt-2">{{ $latest_blog->updated_at->format('d M Y') }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </aside>

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