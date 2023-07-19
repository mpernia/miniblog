<?php

namespace MiniBlog\Shared\Infrastructure\Exceptions;

class ModelNotDefinedException extends InvalidResponseException
{
    public function __construct($exception)
    {
        parent::__construct(
            $exception
        );
    }
}
