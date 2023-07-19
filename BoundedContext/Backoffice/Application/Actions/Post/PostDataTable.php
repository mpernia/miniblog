<?php

namespace MiniBlog\BoundedContext\Backoffice\Application\Actions\Post;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;
use MiniBlog\Shared\Domain\Contracts\DataTableInterface;

class PostDataTable implements DataTableInterface
{
    public static function source()
    {
        $repository = new PostRepository;

        return $repository->with(['categories', 'tags'])->select(sprintf('%s.*', $repository->table()));
    }
}
