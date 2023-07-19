<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagFinder;

class TagController extends Controller
{
    public function index(Request $request)
    {
        //TagFinder::all();
    }

    public function show(int $id)
    {
        //TagFinder::find($id);
    }
}
