<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Traits\RelatedPost;
use MiniBlog\BoundedContext\Frontend\Infrastructure\Traits\SectionLoader;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostFinder;

class PostController extends Controller
{
    use SectionLoader;
    use RelatedPost;

    public function index(Request $request)
    {
        //PostFinder::all();
        return view('frontend.post');
    }

    public function show(int|string $id)
    {
        $post = PostFinder::find($id, 'slug');

        $sections = $this->loadSections(1);

        $relatedPosts = $this->throughCategories($post);

        return view('frontend.post', compact('post', 'sections'));
    }
}
