<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function __invoke()
    {
        return view('frontend.aboutus');
    }
}
