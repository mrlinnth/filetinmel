@if ($paginator->hasPages())
    <nav class="mt-10">
        <ul class="flex">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="mr-6" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="text-gray-400 cursor-not-allowed" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="mr-6">
                    <a class="text-teal-500 hover:text-teal-80" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="mr-6" aria-disabled="true"><span class="text-gray-400 cursor-not-allowed">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="mr-6 font-bold" aria-current="page"><span class="text-teal-500 hover:text-teal-80">{{ $page }}</span></li>
                        @else
                            <li class="mr-6"><a class="text-teal-500 hover:text-teal-80" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="mr-6">
                    <a class="text-teal-500 hover:text-teal-80" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="mr-6" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="text-gray-400 cursor-not-allowed" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
