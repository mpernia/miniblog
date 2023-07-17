<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Role;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\RoleRepository;
use MiniBlog\Shared\Domain\Contracts\DestroyerInterface;

class RoleDestroyer implements DestroyerInterface
{
    public static function destroy(int|string $value) : void
    {
        $repository = new RoleRepository;

        $repository->delete($value);
    }
}
