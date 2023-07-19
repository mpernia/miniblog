<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Posts;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PostDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;
use MiniBlog\Shared\Domain\Contracts\FinderInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PostFinder implements FinderInterface
{
    public static function find(int|string $value) : DataTransferObject
    {
        $repository = new PostRepository;

        $post = $repository->find($value);
        $post->load('categories', 'tags');
        $postDto = new PostDto($post->toArray());
        $postDto->categories = $post->categories()->pluck('name', 'id');
        $postDto->tags = $post->tags()->pluck('name', 'id');
        $postDto->created_at = $post->created_at?->locale(app()->getLocale())->isoFormat(('d MMMM Y')) ;
        $postDto->featured_image = $post->featured_image->url;
        return $postDto;
    }

    public static function all() : array
    {
        $repository = new PostRepository;

        return $repository->all()->toArray();
    }
}
