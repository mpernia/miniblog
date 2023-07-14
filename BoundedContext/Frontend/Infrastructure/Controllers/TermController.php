<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;

class TermController extends Controller
{
    public function __invoke()
    {
        return view('frontend.term');
    }
}
