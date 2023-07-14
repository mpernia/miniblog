<?php

namespace MiniBlog\Shared\Domain\Contracts;

interface DestroyerInterface
{
    public static function destroy(int|string $value, string $key = 'id') : void;
}
