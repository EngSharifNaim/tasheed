@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled page-item"><a  class="page-link"> {{ __('site.previous') }}</a></li>
        @else
            <li  class="page-item"><a  class="page-link" href="{{ $paginator->previousPageUrl() }}" >{{ __('site.previous') }}</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled page-item"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link"  >{{ $page }}</a></li>
                    @else
                        <li class=" page-item"><a class="page-link"  href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class=" page-item"><a  class="page-link" href="{{ $paginator->nextPageUrl() }}" >{{ __('site.next') }}</a></li>
         @endif
    </ul>
@endif
