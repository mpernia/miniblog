@extends('layouts.app')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('assets/frontend/css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ asset('assets/frontend/img/favicon.svg') }}">
    <meta name="theme-color" content="#712cf9">
@endsection

@section('styles')
    @parent
@endsection

@section('content')

    <main class="auth-container d-flex justify-content-center align-items-center vh-100">
        <div class="auth-conten w-100">
            <div class="container">
                <div class="row justify-content-center mb-3">
                    <div class="col-md-4">
                        <img class="rounded mx-auto d-block" src="{{ asset('assets/frontend/img/logo.svg') }}" alt="" width="120" height="120">
                        <h1 class="h3 mb-3 fw-normal text-center"><a href="{{ route('frontend.home') }}">{{ config('setting.name', 'MiniBlog') }}</a></h1>
                    </div>
                </div>
                @yield('auth_content')
            </div>
        </div>
    </main>


@endsection

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
@endsection
