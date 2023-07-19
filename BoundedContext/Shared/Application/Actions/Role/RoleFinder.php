<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Role;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\RoleDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\RoleRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class RoleFinder implements FinderInterface
{
    public static function find(int|string $value) : DataTransferObject
    {
        $repository = new RoleRepository;

        $role = $repository->with(['permissions'])->find($value);
        $roleDto = new RoleDto($role->toArray());
        $roleDto->permissions = $role->permissions->pluck('description', 'id')->toArray();

        return $roleDto;
    }

    public static function all() : array
    {
        $repository = new RoleRepository;

        return $repository->all()->toArray();
    }
}
