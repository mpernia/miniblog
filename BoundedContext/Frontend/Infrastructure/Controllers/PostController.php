<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostFinder;

class PostController extends Controller
{
    public function index(Request $request)
    {
        //PostFinder::all();
    }

    public function show(int $id)
    {
        //PostFinder::find($id);
    }
}
