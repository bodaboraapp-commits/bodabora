@extends('backend.partials.master')
@section('title')
    {{ __('theme.title') }}
@endsection
@section('maincontent')
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-12">
                <div class="page-header">
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"
                                        class="breadcrumb-link">{{ __('levels.dashboard') }}</a></li>
                                <li class="breadcrumb-item"><a href="#"
                                        class="breadcrumb-link">{{ __('menus.settings') }}</a></li>
                                <li class="breadcrumb-item"><a href="#"
                                        class="breadcrumb-link active">{{ __('theme.title') }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body theme-setup-wrap">
                        <form action="{{ route('theme.activate') }}" method="POST" id="themeForm">
                            @csrf

                            <div class="theme-setup-header mb-4">
                                <h3 class="mb-1">{{ __('theme.choose_title') }}</h3>
                                <p class="text-muted mb-0">{{ __('theme.choose_subtitle') }}</p>
                            </div>

                            <div class="theme-cards-track">
                                @foreach ($themes as $theme)
                                        <label class="theme-picker-card {{ $theme->is_active ? 'is-active' : '' }}"
                                            data-theme-card>
                                            <input type="radio" name="theme_id" value="{{ $theme->id }}"
                                                class="theme-radio"
                                                {{ $theme->is_active ? 'checked' : '' }}>

                                            <div class="theme-picker-preview">
                                                <img src="{{ $theme->thumbnail_url }}"
                                                    alt="{{ $theme->theme_name }}" loading="lazy">
                                            </div>

                                            <div class="theme-picker-footer">
                                                <span class="theme-picker-name">{{ $theme->theme_name }}</span>
                                                <span class="theme-picker-check">
                                                    <i class="fas fa-check-circle"></i>
                                                </span>
                                            </div>
                                        </label>
                                @endforeach
                            </div>

                            @error('theme_id')
                                <small class="text-danger d-block mt-2">{{ $message }}</small>
                            @enderror
                        </form>

                        <div class="theme-loading-overlay" id="themeLoading">
                            <div class="spinner-border text-primary" role="status"></div>
                            <span class="mt-2 text-muted">{{ __('theme.applying') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .theme-setup-wrap {
            position: relative;
        }

        .theme-setup-header h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #3d405c;
        }

        .theme-cards-track {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 28px;
        }

        .theme-picker-card {
            position: relative;
            width: 100%;
            min-width: 0;
            margin: 0;
            border: 2px solid #e6e6f2;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            background: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(61, 64, 92, 0.06);
        }

        .theme-picker-card:hover {
            border-color: #c5c5d8;
            box-shadow: 0 4px 14px rgba(61, 64, 92, 0.1);
        }

        .theme-picker-card.is-active {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 1px var(--primary-color), 0 6px 18px color-mix(in srgb, var(--primary-color) 15%, transparent);
        }

        .theme-radio {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
            pointer-events: none;
        }

        .theme-picker-preview {
            background: #f5f6fa;
            padding: 16px 16px 0;
            border-bottom: 1px solid #e6e6f2;
        }

        .theme-picker-preview img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            object-position: top center;
            display: block;
            border-radius: 8px 8px 0 0;
            background: #fff;
        }

        .theme-picker-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 20px;
            background: #fff;
        }

        .theme-picker-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #3d405c;
        }

        .theme-picker-check {
            font-size: 1.5rem;
            color: transparent;
            transition: color 0.2s ease;
            line-height: 1;
        }

        .theme-picker-card.is-active .theme-picker-check {
            color: var(--primary-color);
        }

        .theme-loading-overlay {
            display: none;
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.88);
            z-index: 5;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }

        .theme-loading-overlay.is-visible {
            display: flex;
        }

        @media (min-width: 1400px) {
            .theme-cards-track {
                grid-template-columns: repeat(2, 1fr);
            }

            .theme-picker-preview img {
                height: 320px;
            }
        }

        @media (max-width: 767px) {
            .theme-cards-track {
                grid-template-columns: 1fr;
            }

            .theme-picker-preview img {
                height: 220px;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        (function() {
            const form = document.getElementById('themeForm');
            const loading = document.getElementById('themeLoading');

            document.querySelectorAll('.theme-radio').forEach(radio => {
                radio.addEventListener('change', function() {
                    const card = this.closest('[data-theme-card]');
                    if (this.checked && card?.classList.contains('is-active')) {
                        return;
                    }

                    document.querySelectorAll('[data-theme-card]').forEach(el => {
                        el.classList.remove('is-active');
                    });
                    card?.classList.add('is-active');

                    loading?.classList.add('is-visible');
                    form.submit();
                });
            });
        })();
    </script>
@endpush
