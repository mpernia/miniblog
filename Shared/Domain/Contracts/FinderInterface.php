<?php

namespace MiniBlog\Shared\Domain\Contracts;

use MiniBlog\Shared\Domain\DataTransferObjects\DataTransferObject;

interface FinderInterface
{
    public static function find(int|string $value, string $column = 'id') : DataTransferObject;

    public static function all() : array;
}
