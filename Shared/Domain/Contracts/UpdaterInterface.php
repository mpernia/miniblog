<?php

namespace MiniBlog\Shared\Domain\Contracts;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

interface UpdaterInterface
{
    public static function update(DataTransferObject $data, int|string $value, string $key = 'id') : void;
}
