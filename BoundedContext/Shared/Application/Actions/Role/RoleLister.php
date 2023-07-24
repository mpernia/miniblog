<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Role;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\RoleRepository;
use MiniBlog\Shared\Domain\Contracts\ListerInterface;

class RoleLister implements ListerInterface
{
    public static function list()
    {
        $repository = new RoleRepository;

        return $repository->pluck('title');
    }
}
