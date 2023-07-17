<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories;
use MiniBlog\BoundedContext\Shared\Domain\Contracts\CategoryRepositoryInterface;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Category;
use MiniBlog\Shared\Infrastructure\Persistences\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function setModel(): string
    {
        return Category::class;
    }
}
