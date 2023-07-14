<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Posts;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;
use MiniBlog\Shared\Domain\Contracts\UpdaterInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PostUpdater implements UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value, string $key = 'id'): void
    {
        $repository = new PostRepository;
    }
}
