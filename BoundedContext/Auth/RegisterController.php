<?php

namespace MiniBlog\BoundedContext\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use MiniBlog\BoundedContext\Shared\Application\Actions\User\UserCreator;
use MiniBlog\BoundedContext\Shared\Domain\DataTransferObjects\UserDto;
use MiniBlog\BoundedContext\Shared\Infrastructure\Requests\StoreUserRequest;
use MiniBlog\Shared\Infrastructure\Providers\RouteServiceProvider;

class RegisterController extends Controller
{


    protected $redirectTo = RouteServiceProvider::BACKOFFICCE;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function registered(Request $request, $user)
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, (new StoreUserRequest)->rules());
    }

    protected function create(array $data)
    {
        return UserCreator::create(
            new UserDto(
                [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
                ]
            )
        );
    }
}
