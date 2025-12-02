@if ($paginator->hasPages())
    <ul class="m-pagination flex items-center gap-2 text-primary-text justify-center lg:gap-3">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        @else
            <li><a class="a-button flex items-center justify-center [&:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed lg:h-9 h-8 bg-primary-btn [&:not(:disabled)]:lg:hover:bg-primary-btn-hover text-primary-text rounded-full text-[14px] w-8 lg:w-9" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                aria-label="@lang('pagination.previous')">«</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="text-neutral-n600 text-sm leading-[1.1875rem] font-semibold" aria-disabled="true"><button class="a-button flex items-center justify-center [&:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed lg:w-9 lg:h-9 bg-transparent lg:hover:bg-black-b100/30 text-primary-text rounded-full w-6 h-6 text-[12px] sm:w-8 sm:h-8 sm:text-[16px] md:w-12 md:h-12">{{ $element }}</button></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="[&_button]:bg-primary [&_button]:hover:bg-primary-hover [&_button]:text-white"><button class="a-button flex items-center justify-center [&:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed lg:h-9 h-8 bg-primary-btn [&:not(:disabled)]:lg:hover:bg-primary-btn-hover text-primary-text rounded-full text-[14px] w-8 lg:w-9">{{ $page }}</button></li>
                    @else
                        <li><a class="a-button flex items-center justify-center [&:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed lg:h-9 h-8 bg-primary-btn [&:not(:disabled)]:lg:hover:bg-primary-btn-hover text-primary-text rounded-full text-[14px] w-8 lg:w-9" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="a-button flex items-center justify-center [&:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed lg:h-9 h-8 bg-primary-btn [&:not(:disabled)]:lg:hover:bg-primary-btn-hover text-primary-text rounded-full text-[14px] w-8 lg:w-9" href="{{ $paginator->nextPageUrl() }}" rel="next"
                aria-label="@lang('pagination.next')">»</a></li>
        @else
        @endif
    </ul>
@endif
