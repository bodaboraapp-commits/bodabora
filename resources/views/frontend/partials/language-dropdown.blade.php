@php
    $languages = [
        'en' => ['label' => __('levels.english'), 'short' => 'EN'],
        'bn' => ['label' => __('levels.bangla'), 'short' => 'BN'],
        'in' => ['label' => __('levels.hindi'), 'short' => 'HI'],
        'ar' => ['label' => __('levels.arabic'), 'short' => 'AR'],
        'fr' => ['label' => __('levels.franch'), 'short' => 'FR'],
        'tr' => ['label' => __(' Turkish'), 'short' => 'TR'],
        'es' => ['label' => __('levels.spanish'), 'short' => 'ES'],
        'zh' => ['label' => __('levels.chinese'), 'short' => 'ZH'],
    ];

    $currentLocale = app()->getLocale();
    $currentLanguage = $languages[$currentLocale] ?? $languages['en'];
@endphp

@once
    <style>
        .frontend-lang-dropdown {
            position: relative;
            display: inline-block;
            z-index: 100000;
        }

        .frontend-lang-dropdown summary {
            list-style: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            min-height: 40px;
            border: 1px solid rgba(34, 197, 94, 0.35);
            background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%);
            color: #166534;
            border-radius: 999px;
            padding: 0.55rem 0.9rem;
            font-size: 0.875rem;
            font-weight: 700;
            line-height: 1;
            box-shadow: 0 8px 20px rgba(22, 101, 52, 0.08);
            transition: all 0.2s ease;
        }

        .frontend-lang-dropdown summary::-webkit-details-marker {
            display: none;
        }

        .frontend-lang-dropdown summary:hover {
            border-color: rgba(22, 163, 74, 0.65);
            color: #15803d;
            transform: translateY(-1px);
        }

        .frontend-lang-dropdown[open] summary {
            border-color: rgba(22, 163, 74, 0.75);
            box-shadow: 0 12px 28px rgba(22, 101, 52, 0.14);
        }

        .frontend-lang-current {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 999px;
            background: #16a34a;
            color: #ffffff;
            font-size: 0.72rem;
            letter-spacing: 0.03em;
        }

        .frontend-lang-label {
            max-width: 84px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .frontend-lang-caret {
            font-size: 0.7rem;
            color: #16a34a;
        }

        .frontend-lang-dropdown-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 0.55rem);
            min-width: 180px;
            background: #ffffff;
            border: 1px solid #dcfce7;
            border-radius: 1rem;
            box-shadow: 0 18px 45px rgba(22, 101, 52, 0.16);
            padding: 0.45rem;
            z-index: 100001;
        }

        .frontend-lang-dropdown-menu a {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.65rem 0.75rem;
            border-radius: 0.75rem;
            color: #14532d;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
            white-space: nowrap;
            transition: all 0.2s ease;
        }

        .frontend-lang-dropdown-menu a:hover,
        .frontend-lang-dropdown-menu a.active {
            background: #f0fdf4;
            color: #15803d;
        }

        .frontend-lang-code {
            color: #16a34a;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.04em;
        }

        @media (max-width: 991.98px) {
            .frontend-lang-dropdown {
                display: block;
                width: 100%;
            }

            .frontend-lang-dropdown summary {
                width: 100%;
                justify-content: space-between;
                border-radius: 0.875rem;
            }

            .frontend-lang-dropdown-menu {
                position: static;
                margin-top: 0.5rem;
                width: 100%;
            }
        }
    </style>
@endonce

<details class="frontend-lang-dropdown">
    <summary aria-label="Language">
        <span class="frontend-lang-current">{{ $currentLanguage['short'] }}</span>
        <span class="frontend-lang-label">{{ $currentLanguage['label'] }}</span>
    </summary>
    <div class="frontend-lang-dropdown-menu">
        @foreach ($languages as $locale => $language)
            <a class="@if ($currentLocale === $locale) active @endif" href="{{ route('setlocalization', $locale) }}">
                <span>{{ $language['label'] }}</span>
                <span class="frontend-lang-code">{{ $language['short'] }}</span>
            </a>
        @endforeach
    </div>
</details>
