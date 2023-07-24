@extends('layouts.frontend')

@section('front_styles')
    @parent
@endsection

@section('front_content')
    <div class="mb-3 rounded">
        <div class="col-md-12 px-0">
            @if($post->featured_image)
                <img class="img-fluid" src="{{ $post->featured_image}}" alt="{{ $post->title }}">
            @else
                <svg class="bd-placeholder-img card-img-top post-thumbnail" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#e9ecef"></rect>
                    <text x="50%" y="50%" fill="#000" dy=".3em">{{ $post->title }}</text>
                </svg>
            @endif
        </div>
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-body-tertiary-no rounded-3">
            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">{{ trans('frontend.mainmenu.home') }}</a></li>
            @foreach($sections->breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->slug }}">{{ $breadcrumb->name }}</a></li>
            @endforeach
        </ol>
    </nav>

    <div class="row g-3">
        <div class="col-md-10 pb-5">
            <h3 class="pb-2 mb-2 fst-italic border-bottom">{{ $post->title }}</h3>
            <div class="row mt-3">
                <div class="col-med-12">
                    {!! $post->content !!}
                </div>
                @if(count($post->tags) > 0)
                    <div class="col-md-12 pt-3">
                        <div class="tags-list">
                            <strong>{{ trans('cruds.tag.title') }}: </strong>
                            <ul>
                                @foreach($post->tags as $tag)
                                    <li><a href="{{-- route('backoffice.tags.show', ) --}}">{{ $tag }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row ">
                <div class="col-md-12 mt-5">
                    <h4 class="pb-2 mb-2 fst-italic border-bottom">{{-- trans('frontend.title') --}}articulos relacionados</h4>
                </div>
                {{--
                @foreach($posts as $post)
                    <div class="col-md-4">
                        @include('partials.frontend.post_card')
                    </div>
                @endforeach
                --}}
            </div>
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
