@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<main>
    <div class="container mx-auto px-4">
        <div class="py-24">
            <h1 class="text-3xl font-bold text-left text-section-heading-text">{{ @$page->title }}</h1>
            <div class="mt-6 text-lg leading-relaxed text-section-desc-text text-left page-content">
                {!! $page->description !!}
            </div>
        </div>
    </div>
</main>
@endsection
