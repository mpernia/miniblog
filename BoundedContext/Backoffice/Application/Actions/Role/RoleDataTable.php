<?php

namespace MiniBlog\BoundedContext\Backoffice\Application\Actions\Role;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\RoleRepository;
use MiniBlog\Shared\Domain\Contracts\DataTableInterface;

class RoleDataTable implements DataTableInterface
{
    public static function source()
    {
        $repository = new RoleRepository;

        return $repository->with(['permissions'])->select(sprintf('%s.*', $repository->table()));
    }
}
