<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use MiniBlog\BoundedContext\Frontend\Application\Actions\Post\PostPaginator;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Traits\SectionLoader;

class HomeController extends Controller
{
    use SectionLoader;

    public function __invoke()
    {
        $posts = PostPaginator::paginate();
        $sections = $this->loadSections();

        return view('frontend.home', compact('posts', 'sections'));
    }
}
