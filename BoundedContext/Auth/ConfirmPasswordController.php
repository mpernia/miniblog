<?php

namespace MiniBlog\BoundedContext\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use MiniBlog\Shared\Infrastructure\Providers\RouteServiceProvider;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected $redirectTo = RouteServiceProvider::BACKOFFICCE;

    public function __construct()
    {
        $this->middleware('auth');
    }
}
