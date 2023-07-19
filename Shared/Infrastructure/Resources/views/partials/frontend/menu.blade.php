
<div class="position-sticky" style="top: 4rem;">
    <h3 class="pb-2 mb-2 fst-italic border-bottom">{{ trans('frontend.categories') }}</h3>
    <div class="pb-4">
        <ol class="list-unstyled mb-0">
            <li><a href="{{ route('frontend.categories.show', ['uncategorized']) }}">{{ trans('frontend.uncategorized') }}</a></li>
            @foreach($categories as $id => $name)
                <li><a href="{{ route('frontend.categories.show', [$id]) }}">{{ $name }}</a></li>
            @endforeach
        </ol>
    </div>

    <h3 class="pb-2 mb-2 fst-italic border-bottom">{{ trans('frontend.tags') }}</h3>
    <div class="tag-cloud">
        @foreach ($tags as $tag)
            <a href="{{ route('frontend.tags.show', $tag->id) }}" style="font-size: {{ $tag->score }}px;">{{ $tag->name }}</a>
        @endforeach
    </div>
</div>
