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
                    <div class="col-md-4">
                        @include('partials.frontend.post_card')
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
