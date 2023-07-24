<?php

namespace MiniBlog\Shared\Infrastructure\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MiniBlog\Shared\Infrastructure\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class IsAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::BACKOFFICCE);
            }
        }

        return $next($request);
    }
}
