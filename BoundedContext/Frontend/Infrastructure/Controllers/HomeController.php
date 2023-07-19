<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use MiniBlog\BoundedContext\Frontend\Application\Actions\Home\PostPaginator;
use MiniBlog\BoundedContext\Frontend\Application\Actions\Home\TagScorer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryLister;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = PostPaginator::paginate();
        $categories = CategoryLister::list();
        $tags = TagScorer::score();

        return view('frontend.home', compact('posts', 'tags', 'categories'));
    }
}
