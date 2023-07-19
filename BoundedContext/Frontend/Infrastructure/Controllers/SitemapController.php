<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;

class SitemapController extends Controller
{
    public function __invoke()
    {
        return view('frontend.sitemap');
    }
}
