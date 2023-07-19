<?php

namespace MiniBlog\BoundedContext\Backoffice\Application\Actions\Post;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PostDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PostEditor
{
    public static function edit(int|string $value) : DataTransferObject
    {
        $repository = new PostRepository;

        $post = $repository->find($value);
        $post->load('categories', 'tags');
        $postDto = new PostDto($post->toArray());
        $postDto->categories = $post->categories()->pluck('id');
        $postDto->tags = $post->tags()->pluck('id');

        return $postDto;
    }
}
