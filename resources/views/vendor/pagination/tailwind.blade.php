@if ($paginator->hasPages())
    <nav role="navigation" class="flex items-center justify-center my-8 space-x-2">

        {{-- Previous Page --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">
                Prev
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            {{-- “…” Separator --}}
            @if (is_string($element))
                <span class="px-3 py-2 text-gray-500">...</span>
            @endif

            {{-- Page Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 bg-indigo-600 text-white rounded-lg shadow">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100">
                Next
            </a>
        @else
            <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                Next
            </span>
        @endif
    </nav>
@endif
