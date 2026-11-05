@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$blog->title }} | {{ settings()->name }}
@endsection
@section('content')
<!-- blog detail section -->
    <main>
        <section class="container mx-auto px-6 lg:px-12 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main blog content (left) -->
                <article class="lg:col-span-2">
                    <div class="card-inner gradient-border p-8">
                        <div class="w-full h-64 bg-gray-200 rounded-lg overflow-hidden mb-6">
                            <img src="{{ $blog->image }}" alt="{{ $blog->title }}"
                                class="w-full h-full object-cover">
                        </div>

                        <h1 class="text-3xl lg:text-4xl font-extrabold mb-2">{{ @$blog->title }}</h1>
                        <div class="text-sm text-gray-500 mb-6">{{ __('levels.by') }} <strong>{{ @$blog->user->name }}</strong> | {{ $blog->updated_at->format('d M Y h:i A') }} | {{ $blog->views }} {{ __('levels.views') }}</div>

                        <div class="prose max-w-none mb-6">
                            {!! $blog->description !!}
                        </div>

                        <div class="mt-6 flex gap-3">
                            <a href="{{ route('get.blogs') }}"
                                class="inline-block bg-brand-600 hover:bg-brand-700 text-white px-4 py-2 rounded-lg">{{ __('levels.blogs') }}</a>
                        </div>
                    </div>
                </article>

                <!-- Sidebar (right) -->
                <aside class="lg:col-span-1">
                    <div class="glass-container p-6 rounded-xl shadow-sm">
                        <h3 class="text-lg font-bold mb-4">{{ __('levels.latest_blogs') }}</h3>
                        <ul class="space-y-4">
                            @foreach ($latest_blogs as $latest_blog)
                                <li class="flex items-start gap-3">
                                    <a href="{{ route('blog.details', $latest_blog->id) }}" class="w-16 h-12 rounded overflow-hidden bg-gray-100 flex-shrink-0">
                                        <img src="{{ $latest_blog->image }}" alt="{{ $latest_blog->title }}" class="w-full h-full object-cover">
                                    </a>
                                    <div>
                                        <a href="{{ route('blog.details', $latest_blog->id) }}" class="font-semibold block hover:underline">{{ \Illuminate\Support\Str::limit($latest_blog->title, 45) }}</a>
                                        <div class="text-xs text-gray-500">{{ $latest_blog->updated_at->format('d M Y') }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </section>
    </main>
    <!-- end blog detail section -->

    <!-- 10. FOOTER -->
@push('scripts')
<style>
        .animate-fade-in {
            animation: fadeIn 0.25s ease-out;
        }

        .mobile-menu {
            max-height: 0;
            opacity: 0;
            transform: translateY(-8px);
            overflow: hidden;
            transition: max-height 0.3s ease, opacity 0.3s ease, transform 0.3s ease;
        }

        .mobile-menu.open {
            max-height: 900px;
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        function setMobileMenuState(isOpen) {
            mobileMenu.classList.toggle('open', isOpen);
            mobileMenu.setAttribute('aria-hidden', String(!isOpen));
            mobileMenuButton.setAttribute('aria-expanded', String(isOpen));
        }

        mobileMenuButton?.addEventListener('click', () => {
            setMobileMenuState(!mobileMenu.classList.contains('open'));
        });

        mobileMenu?.querySelectorAll('a, button').forEach(item => {
            item.addEventListener('click', () => setMobileMenuState(false));
        });

    </script>
@endpush

@endsection