@if ($paginator->hasPages())
    <nav>
        <ul class="pagination-box">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="previous" href="#">
                        <i class="pe-7s-angle-left"></i>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="pe-7s-angle-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
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

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="next" rel="next" aria-label="@lang('pagination.next')"><i class="pe-7s-angle-right"></i></a>
                </li>
            @else
                <li class="disabled next" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a class="previous" href="#">
                        <i class="pe-7s-angle-right"></i>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
