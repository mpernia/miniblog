<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Posts;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PostFinder implements FinderInterface
{
    public static function find(int|string $value, string $key = 'id'): DataTransferObject
    {
        $repository = new PostRepository;
    }

    public static function all(): array
    {
        $repository = new PostRepository;
    }
}
