<?php

namespace MiniBlog\BoundedContext\Backend\Infrastructure\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \MiniBlog\Shared\Infrastructure\Persistences\Models\User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [

        ];
    }
}
