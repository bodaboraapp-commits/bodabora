@extends(active_theme() . '.layouts.master')
@section('title')
    {{ __('levels.blogs') }} | {{ settings()->name }}
@endsection
@section('content')
<!-- blog section -->
    <main class="py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold mb-4">{{ __('levels.blogs') }}</h1>
            <p class="text-gray-600 mb-12">Latest insights on logistics, delivery tips, and {{ settings()->name }} updates.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <a href="{{ route('blog.details', $blog->id) }}"
                        class="block bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition-shadow">
                        <div
                            class="relative h-48 bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center overflow-hidden">
                            <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover" />
                        </div>
                        <div class="p-6">
                            <span
                                class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">{{ __('levels.blogs') }}</span>
                            <h3 class="text-lg font-bold mt-3 mb-2">{{ $blog->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($blog->description ?? ''), 120) }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                <span><i class="fas fa-user-circle mr-1"></i>{{ @$blog->user->name }}</span>
                                <span><i class="fas fa-calendar-alt mr-1"></i>{{ $blog->updated_at->format('d M Y') }}</span>
                            </div>
                            <span class="text-emerald-600 font-semibold text-sm hover:text-emerald-700">Read More &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                {{ $blogs->onEachSide(1)->links('frontend.partials.pagination') }}
            </div>
        </div>
    </main>

 <!-- ================= FOOTER ================= -->
@push('scripts')
<style>
        .active-tab {
            border: 2px solid #10b981;
            transform: translateX(6px);
        }
    </style>

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