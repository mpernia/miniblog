<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Posts;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;
use MiniBlog\Shared\Domain\Contracts\DestroyerInterface;

class PostDestroyer implements DestroyerInterface
{
    public static function destroy(int|string $value) : void
    {
        $repository = new PostRepository;

        $repository->delete($value);
    }
}
