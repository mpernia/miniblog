@extends('layouts.frontend')

@section('front_styles')
    @parent
@endsection

@section('front_content')
    <div class="mb-3 rounded">
        <div class="col-md-12 px-0">
            <img class="img-fluid" src="{{ $post->featured_image}}" alt="Thumbnail">
        </div>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb pb-3 bg-body-tertiary-no rounded-3">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
    <div class="row g-3 border-bottom">
        <div class="col-md-10">
            <h3 class="pb-2 mb-2 fst-italic">{{ trans('frontend.title') }}</h3>
        </div>
        <div class="col-md-2">
            <small class="mb-1 text-body-secondary">{{ $post->created_at }}</small>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-med-12">
            {!! $post->content !!}
        </div>
        @if(count($post->tags) > 0)
            <div class="col-md-12">
                <div class="tags-list">
                    <strong>{{ trans('cruds.tag.title') }}</strong>
                    <ul>
                        @foreach($post->tags as $tag)
                            <li><a href="{{-- route('backoffice.tags.show', ) --}}">{{ $tag }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
         @endif
    </div>
    <div class="row g-3 border-bottom">
        <div class="col-md-12 mt-5">
            <h3 class="pb-2 mb-2 fst-italic">{{-- trans('frontend.title') --}}articulos relacionados</h3>
        </div>
        {{--
        @foreach($posts as $post)
            <div class="col-md-4">
                @include('partials.frontend.post_card')
            </div>
        @endforeach
        --}}
    </div>
@endsection

@section('front_scripts')
    @parent
    @yield('front_partial_scripts')
@endsection
