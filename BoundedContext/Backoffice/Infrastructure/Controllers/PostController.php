<?php

namespace MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Backoffice\Application\Actions\Category\CategoryLister;
use MiniBlog\BoundedContext\Backoffice\Application\Actions\Post\PostDataTable;
use MiniBlog\BoundedContext\Backoffice\Application\Actions\Post\PostEditor;
use MiniBlog\BoundedContext\Backoffice\Application\Actions\Post\PostEditorImageUploader;
use MiniBlog\BoundedContext\Backoffice\Domain\DataTransferObjects\NewPostDto;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Posts\PostUpdater;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagLister;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PostDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StorePostRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdatePostRequest;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Post;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PostController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $table = Datatables::of(PostDataTable::source());

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

        $categories = CategoryLister::list();
        $tags       = TagLister::list();

        return view('backoffice.post.index', compact('categories', 'tags'));
    }

    public function create()
    {
        //abort_if(Gate::denies('post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = CategoryLister::list();
        $tags = TagLister::list();

        return view('backoffice.post.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        //abort_if(Gate::denies('post_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        PostCreator::create(
            new NewPostDto($request->all())
        );

        return redirect()->route('backoffice.posts.index');
    }

    public function edit(int $id)
    {
        //abort_if(Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = CategoryLister::list();
        $tags = TagLister::list();
        $post = PostEditor::edit($id);

        return view('backoffice.post.edit', compact('categories', 'post', 'tags'));
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post = PostFinder::find($id);

        return view('backoffice.post.show', compact( 'post'));
    }

    public function update(UpdatePostRequest $request, int $id)
    {
        //abort_if(Gate::denies('post_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        PostUpdater::update(
            new PostDto($request->all()),
            $id
        );

        return redirect()->route('backoffice.posts.index');
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        PostDestroyer::destroy($id);

        return back();
    }

    public function storeCKEditorImages(Request $request): JsonResponse
    {
        //abort_if(Gate::denies('post_create') && Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $media = PostEditorImageUploader::upload($request);

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function storeMedia(Request $request): JsonResponse
    {
        //abort_if(Gate::denies('post_create') && Gate::denies('post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }

        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $path = storage_path('tmp/uploads');

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
