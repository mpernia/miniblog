<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Role;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\RoleRepository;
use MiniBlog\Shared\Domain\Contracts\CreatorInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class RoleCreator implements CreatorInterface
{
    public static function create(DataTransferObject $data): void
    {
        $repository = new RoleRepository;
    }
}
