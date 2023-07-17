<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Posts;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PostDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PostFinder implements FinderInterface
{
    public static function find(int|string $value) : DataTransferObject
    {
        $repository = new PostRepository;

        $row = $repository->find($value);

        return new PostDto($row->toArray());
    }

    public static function all() : array
    {
        $repository = new PostRepository;

        return $repository->all()->toArray();
    }
}
