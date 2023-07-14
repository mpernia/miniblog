<?php

namespace MiniBlog\Shared\Infrastructure\Middlewares;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if ($request->is('dashboard/*') || $request->path() == 'dashboard') {
            $language = config('setting.dashboard_language');
        }
        if (request('change_language')) {
            session()->put('language', request('change_language'));
            $language = request('change_language');
        } elseif (session('language')) {
            $language = session('language');
        } elseif (config('setting.primary_language')) {
            $language = config('setting.primary_language');
        }

        if (isset($language)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
