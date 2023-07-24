<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryFinder;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        //CategoryFinder::all();
    }

    public function show(int|string $id)
    {
        //CategoryFinder::find($id);
    }

    public function allPost()
    {
        //
    }

    public function showPost(int|string $id)
    {
        //
    }
}
