<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Categories;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\CategoryRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class CategoryFinder implements FinderInterface
{

    public static function find(int|string $value, string $key = 'id'): DataTransferObject
    {
        $repository = new CategoryRepository;
    }

    public static function all(): array
    {
        $repository = new CategoryRepository;
    }
}
