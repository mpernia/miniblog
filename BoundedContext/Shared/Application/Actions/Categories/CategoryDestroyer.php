<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Categories;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\CategoryRepository;
use MiniBlog\Shared\Domain\Contracts\DestroyerInterface;

class CategoryDestroyer implements DestroyerInterface
{
    public static function destroy(int|string $value, string $key = 'id'): void
    {
        $repository = new CategoryRepository;
    }
}
