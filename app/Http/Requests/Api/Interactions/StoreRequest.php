<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Interactions;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'contact' => ['required'],
            'project' => ['nullable'],
            'user' => ['nullable'],
        ];
    }
}
