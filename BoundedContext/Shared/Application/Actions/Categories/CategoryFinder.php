<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Categories;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\CategoryDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\CategoryRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class CategoryFinder implements FinderInterface
{

    public static function find(int|string $value, string $column = 'id'): DataTransferObject
    {
        $repository = new CategoryRepository;
        $repository->setRouteKeyName($column);

        $category = $repository->find($value);
        $category->load('parent');
        $categoryDto = new CategoryDto($category->toArray());

        return $categoryDto;
    }

    public static function all(): array
    {
        $repository = new CategoryRepository;

        return $repository->all()->toArray();
    }
}
