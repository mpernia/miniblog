<?php

namespace MiniBlog\Shared\Infrastructure\Exceptions;

class UndefinedMethodException extends InvalidResponseException
{
    public function __construct($method, $class)
    {
        parent::__construct(
            "PHP Error: Call to undefined method {$class}::{$method}()"
        );
    }
}
