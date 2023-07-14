<?php

namespace MiniBlog\BoundedContext\Frontend\Infrastructure\Middlewares;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Frontend extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if (!$request->expectsJson()) {
            return route('frontend.home');
        }
    }
}
