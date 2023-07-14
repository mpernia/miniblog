<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\User;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\UserRepository;
use MiniBlog\Shared\Domain\Contracts\UpdaterInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class UserUpdater implements UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value, string $key = 'id'): void
    {
        $repository = new UserRepository;
    }
}
