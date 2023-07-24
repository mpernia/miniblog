<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories;

use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Shared\Domain\Contracts\PostRepositoryInterface;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Post;
use MiniBlog\Shared\Infrastructure\Persistences\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    protected  string $routeKeyName = 'slug';

    public function setModel(): string
    {
        return Post::class;
    }

    public function addFromRequestToMediaCollection(Request $request)
    {
        $this->model->id     = $request->input('crud_id', 0);
        $this->model->exists = true;

        return $this->model->addMediaFromRequest('upload')->toMediaCollection('ck-media');
    }
}
