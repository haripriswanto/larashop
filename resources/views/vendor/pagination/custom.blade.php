
@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-left">
    @if ($paginator->onFirstPage())
        <li class="page-item disabled">
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"  class="page-link">
                <i class="fas fa-angle-left"></i> Prev
            </a>
        </li>
    @else
        <li class="page-item">
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"  class="page-link">
                <i class="fas fa-angle-left"></i> Prev
            </a>
        </li>
    @endif  
    @foreach ($elements as $element)
        @if (is_string($element))
            <li class="page-item disabled">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"  class="page-link">
                    <span>{{ $element }}</span>
                </a>
            </li>
        @endif       
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="active my-active page-item disabled">
                        <a href="{{ $paginator->previousPageUrl() }}" class="page-link disabled">
                            <span>{{ $page }}</span>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach


    
    @if ($paginator->hasMorePages())
        <li class="page-item">
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link">
                Next <i class="fas fa-angle-right"></i>
            </a>
        </li>
    @else
        <li class="page-item disabled">
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link">
                Next <i class="fas fa-angle-right"></i>
            </a>            
        </li>
    @endif
</ul>
@endif 