<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Permission;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PermissionRepository;
use MiniBlog\Shared\Domain\Contracts\CreatorInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PermissionCreator implements CreatorInterface
{
    public static function create(DataTransferObject $data): void
    {
        $repository = new PermissionRepository;
    }
}
