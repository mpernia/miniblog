<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\User;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\UserDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\UserRepository;
use MiniBlog\Shared\Domain\Contracts\CreatorInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class UserCreator implements CreatorInterface
{
    public static function create(DataTransferObject $data) : DataTransferObject
    {
        $repository = new UserRepository;

        $row = $repository->create($data->toArray());

        return new UserDto($row->toArray());
    }
}
