<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Categories;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\CategoryRepository;
use MiniBlog\Shared\Domain\Contracts\CreatorInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class CategoryCreator implements CreatorInterface
{
    public static function create(DataTransferObject $data): void
    {
        $repository = new CategoryRepository;
    }
}



