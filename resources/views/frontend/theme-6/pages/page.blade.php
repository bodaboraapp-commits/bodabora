@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<section class="t5-page-hero">
    <div class="container">
        <h1 class="t5-page-title">{{ @$page->title }}</h1>
    </div>
</section>
<section class="t5-page-content">
    <div class="container">
        <div class="page-content prose">
            {!! $page->description !!}
        </div>
    </div>
</section>
@endsection
