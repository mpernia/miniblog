<?php

namespace MiniBlog\BoundedContext\Shared\Domain\Contracts;
use Illuminate\Http\Request;

interface PostRepositoryInterface
{
    public function addFromRequestToMediaCollection(Request $request);
}
