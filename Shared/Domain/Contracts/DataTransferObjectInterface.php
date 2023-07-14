<?php

namespace MiniBlog\Shared\Domain\Contracts;

interface DataTransferObjectInterface
{
    public function __set($name, $value);

    public function __isset($name);

    public function __get($name);

    public function toArray(): array;

    public function notNullToArray(): array;
}
