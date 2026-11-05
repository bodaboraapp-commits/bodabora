@extends(active_theme() . '.layouts.master')
@section('title')
    {{ __('levels.blogs') }} | {{ settings()->name }}
@endsection
@section('content')
<section class="t5-page-hero">
    <div class="container">
        <h1 class="t5-page-title">{{ __('levels.blogs') }}</h1>
    </div>
</section>
<section class="t5-page-content">
    <div class="container">
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
                            <div class="d-flex justify-content-between small text-muted">
                                <span><i class="fa fa-user me-1"></i>{{ $blog->user->name }}</span>
                                <span>
                                    <i class="fa fa-eye me-1"></i>{{ $blog->views }}
                                    <i class="fa fa-calendar ms-2 me-1"></i>{{ $blog->updated_at->format('d M Y h:i A') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4 text-center">{{ $blogs->links() }}</div>
    </div>
</section>
@endsection
