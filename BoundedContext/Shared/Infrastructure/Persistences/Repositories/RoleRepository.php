<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories;
use MiniBlog\BoundedContext\Shared\Domain\Contracts\RoleRepositoryInterface;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Role;
use MiniBlog\Shared\Infrastructure\Persistences\Repositories\BaseRepository;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function setModel()
    {
        return Role::class;
    }
}
