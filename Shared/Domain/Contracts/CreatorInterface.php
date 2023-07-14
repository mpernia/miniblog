<?php

namespace MiniBlog\Shared\Domain\Contracts;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

interface CreatorInterface
{
    public static function create(DataTransferObject $data): void;
}
