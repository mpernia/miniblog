<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories;

use MiniBlog\BoundedContext\Shared\Domain\Contracts\TagRepositoryInterface;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Tag;
use MiniBlog\Shared\Infrastructure\Persistences\Repositories\BaseRepository;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function setModel()
    {
        return Tag::class;
    }
}