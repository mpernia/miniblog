<?php

namespace MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class CategoryDto extends DataTransferObject
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'parent_id',
        'parent_name',
    ];
}
