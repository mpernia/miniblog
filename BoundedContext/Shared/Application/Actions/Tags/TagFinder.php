<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Tags;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\TagDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\TagRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class TagFinder implements FinderInterface
{
    public static function find(int|string $value, string $column = 'id') : DataTransferObject
    {
        $repository = new TagRepository;
        $repository->setRouteKeyName($column);

        $tag = $repository->find($value);

        return new TagDto($tag->toArray());
    }

    public static function all() : array
    {
        $repository = new TagRepository;

        return $repository->all()->toArray();
    }
}
