<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories;
use MiniBlog\BoundedContext\Shared\Domain\Contracts\PermissionRepositoryInterface;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Permission;
use MiniBlog\Shared\Infrastructure\Persistences\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function setModel()
    {
        return Permission::class;
    }
}
