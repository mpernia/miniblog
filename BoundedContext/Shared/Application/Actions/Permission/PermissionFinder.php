<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Permission;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PermissionDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PermissionRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PermissionFinder implements FinderInterface
{
    public static function find(int|string $value, string $column = 'id') : DataTransferObject
    {
        $repository = new PermissionRepository;
        $repository->setRouteKeyName('id');

        $permission = $repository->find($value);

        return new PermissionDto($permission->toArray());
    }

    public static function all() : array
    {
        $repository = new PermissionRepository;

        return $repository->all()->toArray();
    }
}
