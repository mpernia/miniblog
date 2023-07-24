<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Traits;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

trait RelatedPost
{
    public function throughCategories(DataTransferObject $post) : array
    {
        $posts = [];

        return $posts;
    }
}
