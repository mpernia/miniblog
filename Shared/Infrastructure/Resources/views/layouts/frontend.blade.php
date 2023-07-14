@extends('layouts.app')

@section('head')
<link href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/frontend/css/app.css') }}" rel="stylesheet" type="text/css">
<link rel="icon" href="{{ asset('assets/frontend/img/favicon.ico') }}">
<meta name="theme-color" content="#712cf9">
@endsection

@section('styles')
    @parent
    @yield('front_styles')
@endsection

@section('content')
    @include('partials.shared.svg')

    <div class="container">
        <header class="border-bottom lh-1 py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-6">
                    <a class="blog-header-logo text-body-emphasis text-decoration-none" href="{{ route('frontend.home') }}">{{ trans('frontend.name') }}</a>
                </div>
                <div class="col-6 d-flex justify-content-end align-items-center">
                    <a class="link-secondary" href="#" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                             stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             class="mx-3" role="img" viewBox="0 0 24 24">
                            <title>{{ trans('global.search') }}</title>
                            <circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
                    </a>
                    <a class="btn btn-sm btn-outline-secondary" href="#">{{ trans('frontend.mainmenu.login') }}</a>
                </div>
            </div>
        </header>

        <div class="nav-scroller py-1 mb-3 border-bottom px-3">
            <nav class="nav nav-underline justify-content-between">
                <a class="nav-item nav-link link-body-emphasis active" href="{{ route('frontend.home') }}">{{ trans('frontend.mainmenu.home') }}</a>
                <a class="nav-item nav-link link-body-emphasis" href="{{ route('frontend.contacts') }}">{{ trans('frontend.mainmenu.contact') }}</a>
                <a class="nav-item nav-link link-body-emphasis" href="{{ route('frontend.cookies') }}">{{ trans('frontend.mainmenu.cookie') }}</a>
                <a class="nav-item nav-link link-body-emphasis" href="{{ route('frontend.faqs') }}">{{ trans('frontend.mainmenu.faq') }}</a>
                <a class="nav-item nav-link link-body-emphasis" href="{{ route('frontend.policies') }}">{{ trans('frontend.mainmenu.policy') }}</a>
                <a class="nav-item nav-link link-body-emphasis" href="{{ route('frontend.terms') }}">{{ trans('frontend.mainmenu.term') }}</a>
            </nav>
        </div>
    </div>
    <main class="container mb-5 pb-5">

    @yield('front_content')

    </main>

    <div class="container fixed-bottom bg-white">
        <footer class="d-flex flex-wrap justify-content-between align-items-center pt-4 pb-3 mt-4 mb-3 border-top">
            <div class="container">
                <smal class="float-end mb-1"><a href="#">{{ trans('global.back_to_top') }}</a></smal>
                <smal class="mb-1"> &copy; 2023, {{ trans('frontend.copyright') }}</smal>
            </div>
        </footer>
    </div>

    @include('partials.frontend.lang')

@endsection

@section('scripts')
    @parent
    <script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}"></script>
    @yield('front_scripts')
@endsection
