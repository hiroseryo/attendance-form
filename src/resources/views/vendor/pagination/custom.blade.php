@if ($paginator->hasPages())
<ul class="pagination">
    @if ($paginator->onFirstPage())
    <li class="disabled"><span>&laquo;</span></li>
    @else
    <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
    @endif

    @foreach ($elements as $element)
    @if (is_string($element))
    <li class="disabled"><span>{{ $element }}</span></li>
    @endif

    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="active"><span>{{ $page }}</span></li>
    @else
    <li><a href="{{ $url }}">{{ $page}}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
    @else
    <li class="disabled"><span>&raquo;</span></li>
    @endif
</ul>
@endif

<style>
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }

    .pagination li a,
    .pagination li span {
        border: 1px solid #ddd;
        padding: 5px 10px;
        text-decoration: none;
        background-color: white;
        color: blue;
    }

    .pagination li.active span {
        background-color: blue;
        color: white;
    }

    .pagination li.disabled span {
        color: blue;
    }

    .pagination li a:hover {
        background-color: blue;
    }
</style>