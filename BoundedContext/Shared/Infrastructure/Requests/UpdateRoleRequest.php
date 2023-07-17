<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['string', 'required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
