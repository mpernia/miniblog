<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'required'],
            'email' => ['email', 'unique:users', 'required'],
            'password' => ['string', 'required', 'min:6', 'max:12'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
