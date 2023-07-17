<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Tags;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\TagRepository;
use MiniBlog\Shared\Domain\Contracts\DestroyerInterface;

class TagDestroyer implements DestroyerInterface
{
    public static function destroy(int|string $value) : void
    {
        $repository = new TagRepository;

        $repository->delete($value);
    }
}
