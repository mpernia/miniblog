<?php

namespace MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('backoffice.dashboard');
    }
}
