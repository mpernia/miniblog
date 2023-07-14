<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \MiniBlog\Shared\Infrastructure\Persistences\Models\Tag */
class TagCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
