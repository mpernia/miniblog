<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories;
use MiniBlog\BoundedContext\Shared\Domain\Contracts\UserRepositoryInterface;
use MiniBlog\Shared\Infrastructure\Persistences\Models\User;
use MiniBlog\Shared\Infrastructure\Persistences\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function setModel(): string
    {
        return User::class;
    }
}
