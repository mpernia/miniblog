@extends('layouts.frontend')

@section('front_styles')
    @parent

@endsection

@section('front_content')
<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-4 fst-italic">{{ trans('frontend.name') }}</h1>
            <p class="lead my-3">{{ trans('frontend.slogan')  }}</p>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-10">
            <h3 class="pb-2 mb-2 fst-italic border-bottom">{{ trans('frontend.title') }}</h3>

            <div class="row mb-2 mt-5 row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($posts as $post)
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    @foreach($post->categories as $category)
                                        <strong class="d-inline-block mb-2 text-primary-emphasis mr-2">{{ $category->name }}</strong>
                                    @endforeach
                                    <small class="mb-1 text-body-secondary">{{ $post->created_at }}</small>
                                </div>
                                <h3 class="mb-0">{{ $post->title }}</h3>
                                <p class="card-text">{{ $post->excerpt }}</p>
                                <a href="{{ route('frontend.posts.show', [$post->id]) }}" class="icon-link gap-1 icon-link-hover stretched-link">
                                    {{ trans('global.continue_reading') }}
                                    <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                                </a>
                                {{--
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">{{ trans('global.delete') }}</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">{{ trans('global.edit') }}</button>
                                    </div>
                                </div>
                                --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (count($posts) > 5)
                <div class="row justify-content-center">
                    @include('partials.frontend.paginate')
                </div>
            @endif

        </div>

        <div class="col-md-2">
            @include('partials.frontend.menu')
        </div>
    </div>

@endsection

@section('front_scripts')
    @parent
    @yield('front_partial_scripts')
@endsection
