<?php

namespace MiniBlog\BoundedContext\Backoffice\Application\Actions\Category;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\CategoryRepository;
use MiniBlog\Shared\Domain\Contracts\ListerInterface;

class CategoryLister implements ListerInterface
{
    public static function list()
    {
        $repository = new CategoryRepository;

        return $repository->pluck('name');
    }
}
