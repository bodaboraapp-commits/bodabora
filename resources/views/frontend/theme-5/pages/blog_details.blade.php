@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$blog->title }} | {{ settings()->name }}
@endsection
@section('content')
<main>
        <!-- Blog Detail Section -->
        <section class="bg-slate-50 py-16">
            <div class="container mx-auto px-4">
                <div class="grid gap-10 lg:grid-cols-2">
                    <article class="space-y-6">
                        <div class="rounded-3xl border border-border-green-100 bg-white p-8 shadow-sm">
                            <div
                                class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between border-b border-border-green-100 pb-5 mb-5">
                                <div>
                                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-section-text">By
                                        {{ @$blog->user->name }}</p>
                                    <h1 class="mt-3 text-sm font-semibold text-section-heading-text sm:text-base">{{ @$blog->title }}</h1>
                                </div>
                                <div class="flex flex-wrap items-center gap-2 text-xs text-section-desc-text">
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-section-light-text px-1 py-1"><i
                                            class="fa-regular fa-eye"></i> {{ $blog->views }} views</span>
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-section-light-text px-1 py-1">{{ $blog->updated_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            <div class="overflow-hidden rounded-3xl mt-4">
                                <img src="{{ $blog->image }}"
                                    alt="{{ $blog->title }}" class="w-full h-[420px] object-cover" />
                            </div>
                            <div class="prose prose-slate max-w-none mt-8 text-section-desc-text">
                                {!! $blog->description !!}
                            </div>
                        </div>
                    </article>
                    <aside class="space-y-6">
                        <div class="rounded-3xl border border-border-green-100 bg-white p-6 shadow-sm">
                            <h2 class="text-lg font-semibold text-section-heading-text">{{ __('levels.latest_blogs') }}</h2>
                            <div class="mt-6 space-y-4">
                                @foreach ($latest_blogs as $latest_blog)
                                    <article class="flex items-start gap-4">
                                        <a href="{{ route('blog.details', $latest_blog->id) }}" class="h-20 w-20 shrink-0 rounded-2xl overflow-hidden">
                                            <img src="{{ $latest_blog->image }}"
                                                alt="{{ $latest_blog->title }}" class="h-full w-full object-cover" />
                                        </a>
                                        <div>
                                            <p class="text-xs uppercase tracking-[0.24em] text-section-text">{{ __('levels.blogs') }}</p>
                                            <a href="{{ route('blog.details', $latest_blog->id) }}"
                                                class="mt-2 block font-semibold text-section-heading-text hover:text-section-text">{{ \Illuminate\Support\Str::limit($latest_blog->title, 50) }}</a>
                                            <p class="mt-2 text-sm text-slate-500">{{ $latest_blog->updated_at->format('d M Y') }}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </aside>
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