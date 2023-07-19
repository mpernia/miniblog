<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Tags;

use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\TagDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\TagRepository;
use MiniBlog\Shared\Domain\Contracts\CreatorInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class TagCreator implements CreatorInterface
{
    public static function create(DataTransferObject $data) : DataTransferObject
    {
        $repository = new TagRepository;

        $row = $repository->create($data->toArray());

        return new TagDto($row->toArray());
    }
}
