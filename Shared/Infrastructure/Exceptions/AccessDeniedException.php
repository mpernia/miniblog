<?php

namespace MiniBlog\Shared\Infrastructure\Exceptions;

class AccessDeniedException extends InvalidResponseException
{
    public function __construct($code, $message)
    {
        parent::__construct(
            '"error": "Invalid access.", "code": "' . $code .'", ' . $message
        );
    }
}
