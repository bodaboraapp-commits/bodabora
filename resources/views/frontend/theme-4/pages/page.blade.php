@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<main class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
    <h1 class="text-4xl font-black text-center text-section-text">{{ @$page->title }}</h1>
    <div class="mt-6 text-body-text max-w-4xl mx-auto leading-8 page-content">
        {!! $page->description !!}
    </div>
</main>
@endsection
