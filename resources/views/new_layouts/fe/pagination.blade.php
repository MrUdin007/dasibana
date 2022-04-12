@if ($paginator->hasPages())
<div class="pagination-ouz">
    <nav aria-label="Page navigation">
        @if(Route::is('produk.detail'))
        <ul class="pagination justify-content-end">
        @else
        <ul class="pagination justify-content-center">
        @endif
            {{-- Previous Page Link --}}
            <li class="page-item @if($paginator->onFirstPage()) disabled @endif">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <a class="page-link" href="#">
                            {{ $element }}
                        </a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item @if($page == $paginator->currentPage()) active @endif">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <li class="page-item @if(!$paginator->hasMorePages()) disabled @endif">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>
@endif