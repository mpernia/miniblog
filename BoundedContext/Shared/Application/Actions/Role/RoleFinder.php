<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Role;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\RoleRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class RoleFinder implements FinderInterface
{
    public static function find(int|string $value, string $key = 'id'): DataTransferObject
    {
        $repository = new RoleRepository;
    }

    public static function all(): array
    {
        $repository = new RoleRepository;
    }
}
