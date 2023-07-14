<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Tags;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\TagRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class TagFinder implements FinderInterface
{
    public static function find(int|string $value, string $key = 'id'): DataTransferObject
    {
        $repository = new TagRepository;
    }

    public static function all(): array
    {
        $repository = new TagRepository;
    }
}
