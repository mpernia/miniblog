<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Posts;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PostDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;
use MiniBlog\Shared\Domain\Contracts\UpdaterInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class PostUpdater implements UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value) : DataTransferObject
    {
        $repository = new PostRepository;

        $post = $repository->update($value, $data->toArray());
        $post->categories()->sync($data->categories, []);
        $post->tags()->sync($data->tags, []);
        if ($data->featured_image){
            if (!$post->featured_image || $data->featured_image !== $post->featured_image->file_name) {
                if ($post->featured_image) {
                    $post->featured_image->delete();
                }
                $post->addMedia(storage_path('tmp/uploads/' . basename($data->featured_image)))->toMediaCollection('featured_image');
            }
        } elseif ($post->featured_image) {
            $post->featured_image->delete();
        }

        return new PostDto($post->toArray());
    }
}
