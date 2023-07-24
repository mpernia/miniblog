<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories;

use MiniBlog\BoundedContext\Shared\Domain\Contracts\TagRepositoryInterface;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Tag;
use MiniBlog\Shared\Infrastructure\Persistences\Repositories\BaseRepository;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    protected  string $routeKeyName = 'slug';

    public function setModel(): string
    {
        return Tag::class;
    }
}
