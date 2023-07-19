<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;

class CookieController extends Controller
{
    public function __invoke()
    {
        return view('frontend.cookie');
    }
}
