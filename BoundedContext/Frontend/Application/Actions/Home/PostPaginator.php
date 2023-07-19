<?php

namespace MiniBlog\BoundedContext\Frontend\Application\Actions\Home;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;

class PostPaginator
{
    public static function paginate()
    {
        $repository = new PostRepository;

        return $repository->with(['categories', 'tags'])->paginate();
    }
}
