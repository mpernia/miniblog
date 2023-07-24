<?php

namespace MiniBlog\BoundedContext\Frontend\Application\Actions\Category;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\CategoryRepository;

class CategoryBreadcrumbMaker
{
    public static function make(int $id) : array
    {
        $repository = new CategoryRepository;

        return $repository->reverseFind($id);
    }
}
