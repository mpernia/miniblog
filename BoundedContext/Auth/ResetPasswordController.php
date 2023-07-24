<?php

namespace MiniBlog\BoundedContext\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use MiniBlog\Shared\Infrastructure\Providers\RouteServiceProvider;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::BACKOFFICCE;
}
