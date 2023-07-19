<?php

namespace MiniBlog\BoundedContext\Backoffice\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use MiniBlog\BoundedContext\Backoffice\Application\Actions\Tag\TagDataTable;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagCreator;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagDestroyer;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagFinder;
use MiniBlog\BoundedContext\Shared\Application\Actions\Tags\TagUpdater;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\TagDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreTagRequest;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\UpdateTagRequest;
use Yajra\DataTables\Facades\DataTables;

class TagController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(Gate::denies('tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $table = Datatables::of(TagDataTable::source());

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tag_show';
                $editGate = 'tag_edit';
                $deleteGate = 'tag_delete';
                $crudRoutePart = 'tags';

                return view('partials.backoffice.actions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('backoffice.tag.index');
    }

    public function create()
    {
        //abort_if(Gate::denies('tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('backoffice.tag.create');
    }

    public function store(StoreTagRequest $request)
    {
        //abort_if(Gate::denies('tag_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        TagCreator::create(
            new TagDto($request->all())
        );

        return redirect()->route('backoffice.tags.index');
    }

    public function edit(int $id)
    {
        //abort_if(Gate::denies('tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tag = TagFinder::find($id);

        return view('backoffice.tag.edit', compact('tag'));
    }

    public function show(int $id)
    {
        //abort_if(Gate::denies('tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tag = TagFinder::find($id);

        return view('backoffice.tag.show', compact('tag'));
    }

    public function update(UpdateTagRequest $request, int $id)
    {
        //abort_if(Gate::denies('tag_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        TagUpdater::update(
            new TagDto($request->all()),
            $id
        );

        return redirect()->route('backoffice.tags.index');
    }

    public function destroy(int $id)
    {
        //abort_if(Gate::denies('tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        TagDestroyer::destroy($id);

        return back();
    }
}
