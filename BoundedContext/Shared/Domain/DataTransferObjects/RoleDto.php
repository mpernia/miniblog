<?php

namespace MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class RoleDto extends DataTransferObject
{
    protected $fillable = [
        'id',
        'title',
        'permissions',
    ];
}
