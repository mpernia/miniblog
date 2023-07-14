<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagFinder;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Category;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Post;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Tag;

class HomeController extends Controller
{
    public function __invoke()
    {
        //PostFinder::all();
        //CategoryFinder::all();
        //TagFinder::all();
        $posts = Post::with(['categories', 'tags'])->paginate();
        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        return view('frontend.home', compact('posts', 'tags', 'categories'));
    }
}
