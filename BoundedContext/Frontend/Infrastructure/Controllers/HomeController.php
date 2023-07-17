<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use MiniBlog\BoundedContext\Frontend\Application\Actions\Home\CategoryLister;
use MiniBlog\BoundedContext\Frontend\Application\Actions\Home\PostPaginator;
use MiniBlog\BoundedContext\Frontend\Application\Actions\Home\TagScorer;
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
        $posts = PostPaginator::paginate();
        $categories = CategoryLister::list();
        $tags = TagScorer::score();
        
        return view('frontend.home', compact('posts', 'tags', 'categories'));
    }
}
