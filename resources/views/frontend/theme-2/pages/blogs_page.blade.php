@extends(active_theme() . '.layouts.master')
@section('title')
    {{ __('levels.blogs') }} | {{ settings()->name }}
@endsection
@section('content')
<!-- blog section -->
    <main class="py-20 bg-gradient-to-b from-white to-brand-50">
        <div class="container mx-auto px-6 lg:px-12">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-brand-900 mb-4">{{ settings()->name }} {{ __('levels.blogs') }}</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Stay updated with the latest news, tips, and insights
                    about logistics and delivery solutions.</p>
            </div>

            <!-- Blog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($blogs as $blog)
                    <a href="{{ route('blog.details', $blog->id) }}" class="block glass-panel rounded-2xl overflow-hidden hover-lift group">
                        <!-- Image Container -->
                        <div class="relative h-48 overflow-hidden bg-gradient-to-br from-brand-100 to-brand-200">
                            <img src="{{ $blog->image }}"
                                alt="{{ $blog->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-4 left-4">
                                <span
                                    class="inline-block bg-brand-600 text-white text-xs font-bold px-3 py-1 rounded-full">{{ __('levels.blogs') }}</span>
                            </div>
                        </div>
                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-brand-900 mb-2 line-clamp-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 120) }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                <span><i class="fas fa-user-circle mr-1"></i>{{ @$blog->user->name }}</span>
                                <span><i class="fas fa-calendar-alt mr-1"></i>{{ $blog->updated_at->format('d M Y') }}</span>
                            </div>
                            <span
                                class="inline-flex items-center gap-2 text-brand-600 font-semibold hover:text-brand-700 transition-colors">
                                Read More <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                {{ $blogs->onEachSide(1)->links('frontend.partials.pagination') }}
            </div>
        </div>
    </main>
    <!-- end blog section -->

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