<?php

namespace MiniBlog\BoundedContext\Frontend\Application\Actions\Home;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\CategoryRepository;

class CategoryLister
{
    public static function list()
    {
        $repository = new CategoryRepository;

        return $repository->pluck('name', 'id');
    }
}
