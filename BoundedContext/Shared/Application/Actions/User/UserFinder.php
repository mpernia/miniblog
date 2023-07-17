<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\User;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\UserDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\UserRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class UserFinder implements FinderInterface
{
    public static function find(int|string $value) : DataTransferObject
    {
        $repository = new UserRepository;

        $row = $repository->find($value);

        return new userDto($row->toArray());
    }

    public static function all() : array
    {
        $repository = new UserRepository;

        return $repository->all()->toArray();
    }
}
