<?php

namespace MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Shared\Application\Actions\Categories\CategoryFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostUpdater;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagFinder;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PostDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StorePostRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdatePostRequest;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Category;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Post;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Tag;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //PostFinder::all();
        if ($request->ajax()) {
            $query = Post::with(['categories', 'tags'])->select(sprintf('%s.*', (new Post())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'post_show';
                $editGate = 'post_edit';
                $deleteGate = 'post_delete';
                $crudRoutePart = 'posts';

                return view('partials.backoffice.actions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->editColumn('category', function ($row) {
                $labels = [];
                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
                }
                return implode(' ', $labels);
            });

            $table->editColumn('tag', function ($row) {
                $labels = [];
                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }
                return implode(' ', $labels);
            });

            $table->editColumn('excerpt', function ($row) {
                return $row->excerpt ? $row->excerpt : '';
            });

            $table->editColumn('featured_image', function ($row) {
                if ($photo = $row->featured_image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }
                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'category', 'tag', 'featured_image']);

            return $table->make(true);
        }

        $categories = Category::get();
        $tags       = Tag::get();

        return view('backoffice.post.index', compact('categories', 'tags'));
    }

    public function create()
    {
        //abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //CategoryFinder::all();
        //TagFinder::all();

        $categories = Category::pluck('name', 'id');

        $tags = Tag::pluck('name', 'id');

        return view('backoffice.post.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        //abort_if(Gate::denies('post_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        PostCreator::create(
            new PostDto($request->all())
        );
    }

    public function edit(int $id)
    {
        //abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //TagFinder::all();

        $categories = Category::pluck('name', 'id');
        $tags = Tag::pluck('name', 'id');
        $post = PostFinder::find($id);
        $post->load('categories', 'tags');

        return view('backoffice.post.edit', compact('categories', 'post', 'tags'));
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post = PostFinder::find($id);
        $post->load('categories', 'tags');

        return view('backoffice.post.show', compact( 'post'));
    }

    public function update(UpdatePostRequest $request, int $id)
    {
        //abort_if(Gate::denies('post_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        PostUpdater::update(
            new PostDto($request->all()),
            $id
        );
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        PostDestroyer::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
