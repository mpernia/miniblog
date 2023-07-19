<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Permission;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PermissionRepository;
use MiniBlog\Shared\Domain\Contracts\ListerInterface;

class PermissionLister implements ListerInterface
{
    public static function list()
    {
        $repository = new PermissionRepository;

        return $repository->pluck('description', 'id');
    }
}
