<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\User;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\UserRepository;
use MiniBlog\Shared\Domain\Contracts\CreatorInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class UserCreator implements CreatorInterface
{
    public static function create(DataTransferObject $data): void
    {
        $repository = new UserRepository;
    }
}
