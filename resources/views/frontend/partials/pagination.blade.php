@if ($paginator->hasPages())
    @once
        <style>
            .frontend-pagination {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                margin: 0;
                padding: 0;
                list-style: none;
            }

            .frontend-pagination a,
            .frontend-pagination span {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 2.5rem;
                height: 2.5rem;
                padding: 0 0.85rem;
                border: 1px solid #bbf7d0;
                border-radius: 0.75rem;
                background: #ffffff;
                color: #166534;
                font-size: 0.875rem;
                font-weight: 700;
                text-decoration: none;
                box-shadow: 0 8px 20px rgba(22, 101, 52, 0.08);
                transition: all 0.2s ease;
            }

            .frontend-pagination a:hover {
                border-color: #22c55e;
                background: #f0fdf4;
                color: #15803d;
                transform: translateY(-1px);
            }

            .frontend-pagination .active span {
                border-color: #16a34a;
                background: #16a34a;
                color: #ffffff;
            }

            .frontend-pagination .disabled span {
                cursor: not-allowed;
                opacity: 0.45;
                box-shadow: none;
            }

            @media (max-width: 575.98px) {
                .frontend-pagination {
                    gap: 0.35rem;
                }

                .frontend-pagination a,
                .frontend-pagination span {
                    min-width: 2.25rem;
                    height: 2.25rem;
                    padding: 0 0.7rem;
                    font-size: 0.8rem;
                }
            }
        </style>
    @endonce

    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="frontend-pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true"><span>&lsaquo;</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a></li>
            @else
                <li class="disabled" aria-disabled="true"><span>&rsaquo;</span></li>
            @endif
        </ul>
    </nav>
@endif
