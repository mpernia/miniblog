<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['string', 'required'],
            'description' => ['string', 'nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
