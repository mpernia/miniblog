<?php

namespace MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class UserDto extends DataTransferObject
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'roles'
    ];
}
