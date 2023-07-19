<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Role;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\RoleDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\RoleRepository;
use MiniBlog\Shared\Domain\Contracts\CreatorInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class  RoleCreator implements CreatorInterface
{
    public static function create(DataTransferObject $data) : DataTransferObject
    {
        $repository = new RoleRepository;

        $row = $repository->create($data->toArray());

        return new RoleDto($row->toArray());
    }
}
