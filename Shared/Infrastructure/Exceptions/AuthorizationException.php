<?php

namespace MiniBlog\Shared\Infrastructure\Exceptions;

class AuthorizationException extends InvalidResponseException
{
    public function __construct($exception)
    {
        parent::__construct(
            $exception
        );
    }
}
