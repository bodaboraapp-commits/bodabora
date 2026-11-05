@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<main class="min-h-screen flex items-center justify-center bg-gradient-to-br from-brand-50 via-white to-brand-100 py-12 px-6">
    <div class="container mx-auto px-6 lg:px-12 py-10">
        <h1 class="text-3xl text-brand-400 font-semibold mb-6">{{ @$page->title }}</h1>
        <div class="text-sm text-gray-500 text-left page-content">
            {!! $page->description !!}
        </div>
    </div>
</main>
@endsection
