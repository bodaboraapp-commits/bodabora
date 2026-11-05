@extends(active_theme() . '.layouts.master')
@section('title')
    {{ __('levels.home') }} | {{ @settings()->name }}
@endsection
@section('content')
    @include(active_theme() . '.section.banner')
    @include(active_theme() . '.section.service')
    @include(active_theme() . '.section.why_courier')
    @include(active_theme() . '.section.pricing')
    @include(active_theme() . '.section.achievement')
    @include(active_theme() . '.section.gallery')
    @include(active_theme() . '.section.partner')
    @include(active_theme() . '.section.blogs')
@endsection
