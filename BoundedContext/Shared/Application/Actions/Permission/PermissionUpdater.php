<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Permission;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PermissionRepository;
use MiniBlog\Shared\Domain\Contracts\UpdaterInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PermissionUpdater implements UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value, string $key = 'id'): void
    {
        $repository = new PermissionRepository;
    }
}
