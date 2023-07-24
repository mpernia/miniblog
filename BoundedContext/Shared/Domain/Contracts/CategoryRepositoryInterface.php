<?php

namespace MiniBlog\BoundedContext\Shared\Domain\Contracts;
interface CategoryRepositoryInterface
{
    public function reverseFind(int $id) : array;
}
