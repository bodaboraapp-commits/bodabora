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
        <div class="mb-4">{!! $page->description !!}</div>
        <h2 class="fw-bold mb-4">{{ __('levels.read_our_commonly_asked_questions') }}</h2>
        <div class="t5-faq accordion accordion-flush" id="t5FaqAccordion">
            @foreach ($faqs as $key => $faq)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#t5Faq-{{ $key }}">
                            {{ $faq->question }}
                        </button>
                    </h2>
                    <div id="t5Faq-{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#t5FaqAccordion">
                        <div class="accordion-body">{!! $faq->answer !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">{{ $faqs->links() }}</div>
    </div>
</section>
@endsection
