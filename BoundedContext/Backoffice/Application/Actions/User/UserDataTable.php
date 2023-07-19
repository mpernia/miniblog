<?php

namespace MiniBlog\BoundedContext\Backoffice\Application\Actions\User;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\UserRepository;
use MiniBlog\Shared\Domain\Contracts\DataTableInterface;

class UserDataTable implements DataTableInterface
{
    public static function source()
    {
        $repository = new UserRepository;

        return $repository->with(['roles'])->select(sprintf('%s.*', $repository->table()));
    }
}
