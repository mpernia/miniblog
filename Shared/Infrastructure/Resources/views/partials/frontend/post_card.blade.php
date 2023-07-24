<div class="card post-card shadow-sm">
    @if($post->featured_image)
        <div class="post-thumbnail-container">
            <img class="post-thumbnail" src="{{ $post->featured_image->url }}" alt="Thumbnail">
        </div>
    @else
        <svg class="bd-placeholder-img card-img-top post-thumbnail" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#e9ecef"></rect>
            <text x="50%" y="50%" fill="#000" dy=".3em">Thumbnail</text>
        </svg>
    @endif
    <div class="card-body pb-0">
        <div class="d-flex justify-content-between align-items-center">
            @if (count($post->categories) > 0)
                @foreach($post->categories as $category)
                    <strong class="d-inline-block mb-2 text-primary-emphasis mr-2">{{ $category->name }}</strong>
                @endforeach
            @else
                <strong class="d-inline-block mb-2 text-primary-emphasis mr-2">{{ trans('frontend.uncategorized') }}</strong>
            @endif
            <small class="mb-1 text-body-secondary">{{ $post->created_at?->locale(app()->getLocale())->isoFormat(('d MMMM Y')) }}</small>
        </div>
        <h3 class="h4 mb-1">{{ $post->title }}</h3>
        <p class="card-text">{{ Str::words($post->excerpt, $words = 20, $end = '...') }}</p>
    </div>
    <div class="card-footer post-card-footer">
        <a href="{{ route('frontend.posts.show', [$post->id]) }}" class="icon-link gap-1 icon-link-hover stretched-link mb-2">
            {{ trans('global.continue_reading') }}
            <svg class="bi"><use xlink:href="#chevron-right"/></svg>
        </a>
    </div>
</div>
