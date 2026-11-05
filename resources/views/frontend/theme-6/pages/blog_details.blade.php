@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$blog->title }} | {{ settings()->name }}
@endsection
@section('content')
<section class="t5-page-hero">
    <div class="container">
        <h1 class="t5-page-title">{{ $blog->title }}</h1>
        <div class="d-flex flex-wrap gap-3 mt-3 text-muted">
            <span><i class="fa fa-user me-1"></i>{{ $blog->user->name }}</span>
            <span><i class="fa fa-eye me-1"></i>{{ $blog->views }}</span>
            <span><i class="fa fa-calendar me-1"></i>{{ $blog->updated_at->format('d M Y h:i A') }}</span>
        </div>
    </div>
</section>
<section class="t5-page-content">
    <div class="container">
        <div class="row g-5">
            <div class="col-xl-8">
                <img src="{{ $blog->image }}" class="img-fluid rounded-4 mb-4 w-100" alt="{{ $blog->title }}" style="max-height:420px;object-fit:cover;">
                <div class="page-content">{!! $blog->description !!}</div>
            </div>
            <div class="col-xl-4">
                <h3 class="fw-bold mb-4">{{ __('levels.latest_blogs') }}</h3>
                @foreach ($latest_blogs as $latest_blog)
                    <div class="card t5-blog-card mb-3">
                        <div class="row g-0">
                            <div class="col-4">
                                <a href="{{ route('blog.details', $latest_blog->id) }}">
                                    <img src="{{ $latest_blog->image }}" class="img-fluid rounded-start h-100" style="object-fit:cover;min-height:100px;" alt="{{ $latest_blog->title }}">
                                </a>
                            </div>
                            <div class="col-8">
                                <div class="card-body py-2">
                                    <a href="{{ route('blog.details', $latest_blog->id) }}" class="text-decoration-none">
                                        <h6 class="card-title fw-bold mb-1">{{ \Str::limit($latest_blog->title, 40) }}</h6>
                                    </a>
                                    <small class="text-muted"><i class="fa fa-calendar me-1"></i>{{ $latest_blog->updated_at->format('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
