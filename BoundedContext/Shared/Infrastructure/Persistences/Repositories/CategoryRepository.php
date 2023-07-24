<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories;
use Exception;
use MiniBlog\BoundedContext\Shared\Domain\Contracts\CategoryRepositoryInterface;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\CategoryDto;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Category;
use MiniBlog\Shared\Infrastructure\Persistences\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected  string $routeKeyName = 'slug';

    public function setModel(): string
    {
        return Category::class;
    }

    public function reverseFind(int $id): array
    {
        $categories = [];
        try {
            $iterator = $this->findWhereFirst('id', $id);
            while ($iterator) {
                array_unshift($categories, new CategoryDto($iterator->toArray()));
                $iterator = $this->findWhereFirst('id', $iterator->parent_id);
            }
        } catch (Exception $e) {

        }
        return $categories;
    }
}
