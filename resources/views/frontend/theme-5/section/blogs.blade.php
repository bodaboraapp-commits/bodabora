<!-- News & Blogs — two horizontal cards -->
  <section class="scroll-mt-28 py-16 sm:py-20 bg-white">
    <div class="container mx-auto px-4">
      <h2 class="text-2xl sm:text-3xl font-extrabold text-section-heading-text text-center sm:text-left">{{ __('levels.latest_blogs') }}</h2>
      <div class="mt-10 flex flex-col gap-8">
        @foreach ($blogs as $blog)
          @if ($loop->iteration <= 2)
            <a href="{{ route('blog.details', $blog->id) }}"
              class="group flex flex-col sm:flex-row overflow-hidden rounded-xl border border-border-green-100 bg-white shadow-md shadow-emerald-900/5 transition-all duration-300 hover:shadow-xl hover:shadow-emerald-900/10 hover:-translate-y-0.5">
              <div class="{{ $loop->even ? 'order-2 ' : '' }}sm:w-2/5 shrink-0 aspect-video h-[150] sm:min-h-[150px] overflow-hidden">
                <img src="{{ $blog->image }}"
                  alt="{{ $blog->title }}"
                  class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
              </div>
              <div class="{{ $loop->even ? 'order-1 ' : '' }}flex flex-1 flex-col justify-center p-6 sm:p-8">
                <h3
                  class="text-lg font-bold text-blog-heading-text group-hover:text-blog-heading-text-hover transition-colors duration-300">
                  {{ $blog->title }}</h3>
                <p class="mt-2 text-xs font-semibold uppercase tracking-wide text-blog-date-text">{{ $blog->updated_at->format('M d, Y') }}</p>
                <p class="mt-3 text-sm leading-relaxed text-section-desc-text">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 130) }}</p>
                <span
                  class="mt-4 inline-flex w-max items-center gap-1 text-sm font-semibold text-blog-date-text hover:text-blog-more-text-hover transition-colors duration-300">
                  {{ __('levels.read_more') }}&hellip;
                </span>
              </div>
            </a>
          @endif
        @endforeach
      </div>
    </div>
  </section>
