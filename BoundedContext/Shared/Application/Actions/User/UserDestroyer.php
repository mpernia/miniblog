<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\User;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\UserRepository;
use MiniBlog\Shared\Domain\Contracts\DestroyerInterface;

class UserDestroyer implements DestroyerInterface
{
    public static function destroy(int|string $value) : void
    {
        $repository = new UserRepository;

        $repository->delete($value);
    }
}
