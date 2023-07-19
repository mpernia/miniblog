<?php

namespace MiniBlog\BoundedContext\Backoffice\Application\Actions\Tag;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\TagRepository;
use MiniBlog\Shared\Domain\Contracts\DataTableInterface;

class TagDataTable implements DataTableInterface
{
    public static function source()
    {
        $repository = new TagRepository;

        return $repository->query()->select(sprintf('%s.*', $repository->table()));
    }
}
