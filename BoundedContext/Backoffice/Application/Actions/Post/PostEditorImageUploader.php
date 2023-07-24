<?php

namespace MiniBlog\BoundedContext\Backoffice\Application\Actions\Post;

use Illuminate\Http\Request;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\PostRepository;
use MiniBlog\Shared\Infrastructure\Persistences\Models\Post;

class PostEditorImageUploader
{
    public static function upload(Request $request)
    {
        $repository = new PostRepository;

        return $repository->addFromRequestToMediaCollection($request);
    }
}
