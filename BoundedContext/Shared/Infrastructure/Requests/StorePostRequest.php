<?php

namespace MiniBlog\BoundedContext\Shared\Infrastructure\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['string', 'required'],
            'slug' => ['string', 'nullable'],
            'content' => ['string', 'nullable'],
            'excerpt' => ['string', 'nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
