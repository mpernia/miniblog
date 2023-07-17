<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\User;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\UserDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\UserRepository;
use MiniBlog\Shared\Domain\Contracts\UpdaterInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class UserUpdater implements UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value) : DataTransferObject
    {
        $repository = new UserRepository;

        $row = $repository->update($value, $data->toArray());

        return new UserDto($row->toArray());
    }
}
