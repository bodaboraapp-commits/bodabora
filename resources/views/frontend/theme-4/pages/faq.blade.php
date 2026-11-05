@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$page->title }} | {{ settings()->name }}
@endsection
@section('content')
<!-- ========================================= -->
    <!-- FAQ -->
    <!-- ========================================= -->
    <section class="py-28" x-data="{ active: 1 }">

        <div class="max-w-7xl mx-auto px-6 lg:px-8">


            <div>
                <h2 class="mt-6 text-4xl lg:text-5xl font-black leading-tight text-section-deep-text">
                    {{ @$page->title }}
                </h2>

                <p class="mt-6 text-lg text-section-light-text leading-relaxed max-w-lg">
                    {!! @$page->description !!}
                </p>

            </div>

            <div class="space-y-5 mt-5">

                @foreach ($faqs as $key => $faq)
                    <!-- Item -->
                    <div
                        class="bg-white rounded-3xl border border-border-green-100 shadow-sm overflow-hidden transition-all duration-300">

                        <button @click="active = active === {{ $loop->iteration }} ? null : {{ $loop->iteration }}"
                            class="w-full flex items-center justify-between p-6 text-left cursor-pointer">

                            <span class="font-semibold text-lg text-faq-ques-text">
                                {{ @$faq->question }}
                            </span>

                            <span
                                class="w-10 h-10 rounded-full bg-faq-icon-bg flex items-center justify-center text-faq-icon-text text-xl font-bold transition duration-300"
                                :class="active === {{ $loop->iteration }} ? 'rotate-45' : ''">
                                +
                            </span>

                        </button>

                        <div x-show="active === {{ $loop->iteration }}" x-collapse>
                            <div class="px-6 pb-6 text-faq-ans-text leading-relaxed">
                                {!! $faq->answer !!}
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
            <div class="mt-5">
                {{ $faqs->links() }}
            </div>

        </div>

    </section>





    <!-- ========================================= -->
    <!-- FOOTER -->
    <!-- ========================================= -->
@push('scripts')
<!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@endsection
