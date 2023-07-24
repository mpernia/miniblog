<?php

namespace MiniBlog\BoundedContext\Backoffice\Application\Actions\Category;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\CategoryRepository;
use MiniBlog\Shared\Domain\Contracts\DataTableInterface;

class CategoryDataTable implements DataTableInterface
{
    public static function source()
    {
        $repository = new CategoryRepository;

        return $repository->query()->select(sprintf('%s.*', $repository->table()));
    }
}
