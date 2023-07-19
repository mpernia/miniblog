<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Posts;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\PostDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;
use MiniBlog\Shared\Domain\Contracts\CreatorInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PostCreator implements CreatorInterface
{
    public static function create(DataTransferObject $data) : DataTransferObject
    {
        $repository = new PostRepository;

        $post = $repository->create($data->toArray());
        $post->categories()->sync($data->categories, []);
        $post->tags()->sync($data->tags, []);
        if ($data->featured_image){
            $post->addMedia(storage_path('tmp/uploads/' . basename($data->featured_image)))->toMediaCollection('featured_image');
        }
        if ($media = $data->attachments) {
            Media::whereIn('id', $media)->update(['model_id' => $post->id]);
        }

        return new PostDto($post->toArray());
    }
}
