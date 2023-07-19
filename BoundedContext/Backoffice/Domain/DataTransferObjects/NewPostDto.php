<?php

namespace MiniBlog\BoundedContext\Backoffice\Domain\DataTransferObjects;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class NewPostDto extends DataTransferObject
{
    protected $fillable = [
        'title',
        'slug',
        'categories',
        'tags',
        'content',
        'excerpt',
        'attachments',
        'featured_image',
        'attachments',
    ];
    protected ?array $attachments = null;
    protected ?string $featured_image = null;
}
