@extends(active_theme() . '.layouts.master')
@section('title')
    {{ @$blog->title }} | {{ settings()->name }}
@endsection
@section('content')
<!-- Blog Detail Section -->
    <main class="py-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-4 gap-8">
                <!-- Left Sidebar: Related Posts -->
                <div class="lg:col-span-1">
                    <h3 class="text-xl font-bold mb-4">{{ __('levels.latest_blogs') }}</h3>
                    <div class="space-y-4">
                        @foreach ($latest_blogs as $latest_blog)
                            <div class="bg-white rounded-lg shadow p-3 hover:shadow-md transition-shadow">
                                <a href="{{ route('blog.details', $latest_blog->id) }}"
                                    class="block h-24 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded mb-3 overflow-hidden">
                                    <img src="{{ $latest_blog->image }}" alt="{{ $latest_blog->title }}" class="w-full h-full object-cover" />
                                </a>
                                <h4 class="font-semibold text-sm">{{ \Illuminate\Support\Str::limit($latest_blog->title, 45) }}</h4>
                                <p class="text-xs text-gray-500 mt-1">{{ $latest_blog->updated_at->format('d M Y') }}</p>
                                <a href="{{ route('blog.details', $latest_blog->id) }}" class="text-xs text-emerald-600 font-semibold mt-2 hover:underline">Read &rarr;</a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Side: Blog Details -->
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-2xl shadow p-8">
                        <!-- Featured Image -->
                        <div
                            class="h-96 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-xl mb-8 flex items-center justify-center text-6xl overflow-hidden">
                            <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover" />
                        </div>

                        <!-- Article Header -->
                        <div class="mb-6">
                            <span
                                class="inline-block bg-emerald-50 text-emerald-600 text-xs font-semibold px-3 py-1 rounded-full mb-3">{{ __('levels.blogs') }}</span>
                            <h1 class="text-4xl font-extrabold mb-3">{{ @$blog->title }}</h1>
                            <div class="flex flex-wrap items-center gap-4 text-gray-600 text-sm">
                                <span><i class="fas fa-calendar-alt mr-1"></i>{{ $blog->updated_at->format('d M Y h:i A') }}</span>
                                <span><i class="fas fa-user-circle mr-1"></i>By {{ @$blog->user->name }}</span>
                                <span><i class="fas fa-eye mr-1"></i>{{ $blog->views }} views</span>
                            </div>
                        </div>

                        <!-- Article Content -->
                        <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed space-y-4">
                            {!! $blog->description !!}
                        </div>
                    </div>
                </div>
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