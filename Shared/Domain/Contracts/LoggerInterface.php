<?php

namespace MiniBlog\Shared\Domain\Contracts;

interface LoggerInterface
{
    public function info(string $message, array $context = []): void;

    public function warning(string $message, array $context = []): void;

    public function critical(string $message, array $context = []): void;

    public function error(string $message, array $context = []): void;
}
