<?php

namespace MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class TagDto extends DataTransferObject
{
    protected $fillable = [
        'id',
        'name',
        'slug',
    ];
}
