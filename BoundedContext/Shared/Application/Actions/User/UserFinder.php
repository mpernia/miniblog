<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\User;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\UserRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class UserFinder implements FinderInterface
{
    public static function find(int|string $value, string $key = 'id'): DataTransferObject
    {
        $repository = new UserRepository;
    }

    public static function all(): array
    {
        $repository = new UserRepository;
    }
}
