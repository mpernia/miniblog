<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Permission;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PermissionRepository;
use MiniBlog\Shared\Domain\Contracts\DestroyerInterface;

class PermissionDestroyer implements DestroyerInterface
{
    public static function destroy(int|string $value): void
    {
        $repository = new PermissionRepository;
    }
}
