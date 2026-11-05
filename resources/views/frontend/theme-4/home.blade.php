@extends(active_theme() . '.layouts.master')
@section('title')
    {{ settings()->name }}
@endsection
@section('content')
    @include(active_theme() . '.section.banner')
    @include(active_theme() . '.section.service')
    @include(active_theme() . '.section.gallery')
    @include(active_theme() . '.section.pricing')
    @include(active_theme() . '.section.achievement')
    @include(active_theme() . '.section.partner')
    @include(active_theme() . '.section.faq')
    @include(active_theme() . '.section.blogs')
    @include(active_theme() . '.section.cta')
@endsection
@include(active_theme() . '.home-scripts')
