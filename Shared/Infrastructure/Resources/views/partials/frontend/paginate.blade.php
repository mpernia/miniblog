<div class="col-md-6">
    <div class="pagination">
        <ul>
            @if ($posts->onFirstPage())
                <li class="disabled"><span>&laquo;</span></li>
            @else
                <li><a href="{{ $posts->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                @if ($page == $posts->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            @if ($posts->hasMorePages())
                <li><a href="{{ $posts->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="disabled"><span>&raquo;</span></li>
            @endif
        </ul>
    </div>
</div>
