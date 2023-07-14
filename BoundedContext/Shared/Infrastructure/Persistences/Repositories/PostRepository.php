<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories;

use MiniBlog\BoundedContext\Shared\Domain\Contracts\PostRepositoryInterface;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Post;
use MiniBlog\Shared\Infrastructure\Persistences\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function setModel()
    {
        return Post::class;
    }
}
