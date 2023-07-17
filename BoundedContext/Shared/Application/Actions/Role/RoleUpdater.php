<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Role;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\RoleDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\RoleRepository;
use MiniBlog\Shared\Domain\Contracts\UpdaterInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class RoleUpdater implements UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value) : DataTransferObject
    {
        $repository = new RoleRepository;

        $row = $repository->update($value, $data->toArray());

        return new RoleDto($row->toArray());
    }
}
