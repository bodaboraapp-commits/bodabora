<section class="t5-section t5-section-alt">
    <div class="container">
        <div class="text-center mb-5">
            <span class="t5-section-badge">{{ __('levels.blogs') }}</span>
            <h2 class="t5-section-title">{{ __('levels.blogs') }}</h2>
        </div>
        <div class="row g-4">
            @foreach ($blogs as $blog)
                <div class="col-lg-4 col-md-6">
                    <div class="card t5-blog-card">
                        <a href="{{ route('blog.details', $blog->id) }}">
                            <img src="{{ $blog->image }}" class="card-img-top" alt="{{ $blog->title }}">
                        </a>
                        <div class="card-body">
                            <a href="{{ route('blog.details', $blog->id) }}" class="text-decoration-none">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                            </a>
                        </div>
                        <div class="card-footer bg-transparent border-0 pb-3">
                            <div class="d-flex justify-content-between align-items-center small text-muted">
                                <span><i class="fa fa-user me-1"></i>{{ $blog->user->name }}</span>
                                <span>
                                    <i class="fa fa-eye me-1"></i>{{ $blog->views }}
                                    <i class="fa fa-calendar ms-2 me-1"></i>{{ $blog->updated_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('get.blogs') }}" class="btn t5-btn-primary">{{ __('levels.blogs') }}</a>
        </div>
    </div>
</section>
