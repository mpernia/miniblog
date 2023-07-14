<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Categories;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\CategoryRepository;
use MiniBlog\Shared\Domain\Contracts\UpdaterInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class CategoryUpdater implements UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value, string $key = 'id'): void
    {
        $repository = new CategoryRepository;
    }
}
