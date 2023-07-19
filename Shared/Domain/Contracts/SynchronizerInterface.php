<?php

namespace MiniBlog\Shared\Domain\Contracts;

interface SynchronizerInterface
{
    public static function sync(int $id, array $data) : void;
}
