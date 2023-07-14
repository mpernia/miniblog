<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Permission;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PermissionRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PermissionFinder implements FinderInterface
{
    public static function find(int|string $value, string $key = 'id'): DataTransferObject
    {
        $repository = new PermissionRepository;
    }

    public static function all(): array
    {
        $repository = new PermissionRepository;
    }
}
