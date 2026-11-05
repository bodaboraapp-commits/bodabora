<!-- TESTIMONIAL -->
    <!-- ========================================= -->
    <section class="pb-28">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center max-w-3xl mx-auto">

                <span
                    class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-badge-bg text-badge-text text-sm font-semibold">

                    {{ __('levels.latest_blogs') }}

                </span>

                <h2 class="mt-6 text-4xl lg:text-5xl font-black text-section-deep-text">
                    {{ __('levels.trusted_by_happy_customers') }}
                </h2>
                <p class="mt-6 text-section-light-text leading-8">
                    {{ __('levels.blog_section_intro') }}
                </p>

            </div>

            <div class="grid lg:grid-cols-3 gap-8 mt-20">

                @foreach ($blogs as $blog)
                    @if ($loop->iteration <= 3)
                        <!-- Card -->

                        <div class="bg-white rounded-[20px] p-10 shadow-lg border border-border-green-100 gb-card-lift">

                            <div class="text-5xl text-testimo-card-icon">
                                <i class="fa-solid fa-quote-left"></i>
                            </div>

                            <p class="mt-6 text-testimo-card-desc-text leading-8">
                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 120) }}
                            </p>

                            <div class="mt-8">

                                <h4 class="font-black text-xl">
                                    {{ $blog->title }}
                                </h4>

                                <p class="text-testimo-card-name-text mt-1">
                                    {{ @$blog->user->name }}
                                </p>

                            </div>

                        </div>
                    @endif
                @endforeach

            </div>

        </div>

    </section>

    <!-- ========================================= -->
