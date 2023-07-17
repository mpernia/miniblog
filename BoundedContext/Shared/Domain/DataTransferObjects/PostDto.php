<?php

namespace MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PostDto extends DataTransferObject
{
    protected $fillable = [
        'id',
        'title',
        'content',
        'excerpt',
        'created_at',
    ];
}
