
<div class="position-sticky" style="top: 4rem;">
    <h3 class="pb-2 mb-2 fst-italic border-bottom">Categories</h3>
    <div class="pb-4">
        <ol class="list-unstyled mb-0">
            @foreach($categories as $id => $name)
                <li><a href="{{ route('frontend.categories.show', [$id]) }}">{{ $name }}</a></li>
            @endforeach
        </ol>
    </div>

    <h3 class="pb-2 mb-2 fst-italic border-bottom">Tags</h3>
    <div class="pb-4">
        <ol class="list-unstyled">
            @foreach($tags as $id => $name)
                <li><a href="{{ route('frontend.tags.show', [$id]) }}">{{ $name }}</a></li>
            @endforeach
        </ol>
    </div>
</div>