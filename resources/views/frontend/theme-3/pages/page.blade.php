@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<main class="py-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">{{ @$page->title }}</h1>
        <div class="mt-6 text-gray-600 leading-relaxed page-content">
            {!! $page->description !!}
        </div>
    </div>
</main>
@endsection
