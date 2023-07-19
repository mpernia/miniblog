<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Tags;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\TagRepository;
use MiniBlog\Shared\Domain\Contracts\ListerInterface;

class TagLister implements ListerInterface
{
    public static function list()
    {
        $repository = new TagRepository;

        return $repository->pluck('name', 'id');
    }
}
