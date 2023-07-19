<?php

namespace MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PermissionDto extends DataTransferObject
{
    protected $fillable = [
        'id',
        'title',
        'description',
    ];
}
