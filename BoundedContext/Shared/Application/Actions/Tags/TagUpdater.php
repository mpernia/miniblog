<?php

namespace MiniBlog\BoundedContext\Shared\Application\Actions\Tags;

use MiniBlog\BoundedContext\Shared\Infrastructure\Persistences\Repositories\TagRepository;
use MiniBlog\Shared\Domain\Contracts\UpdaterInterface;
use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

class TagUpdater implements UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value, string $key = 'id'): void
    {
        $repository = new TagRepository;
    }
}
