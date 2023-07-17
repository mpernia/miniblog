<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Categories;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\CategoryDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\CategoryRepository;
use MiniBlog\Shared\Domain\Contracts\UpdaterInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class CategoryUpdater implements UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value) : DataTransferObject
    {
        $repository = new CategoryRepository;

        $row = $repository->update($value, $data->toArray());

        return new CategoryDto($row->toArray());
    }
}
