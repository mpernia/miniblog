<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Permission;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PermissionDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PermissionRepository;
use MiniBlog\Shared\Domain\Contracts\UpdaterInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PermissionUpdater implements UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value) : DataTransferObject
    {
        $repository = new PermissionRepository;

        $row = $repository->update($value, $data->toArray());

        return new PermissionDto($row->toArray());
    }
}
