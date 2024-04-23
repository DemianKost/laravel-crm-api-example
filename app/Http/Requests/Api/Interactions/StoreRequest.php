<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Interactions;

use Domains\Interactions\Enums\InteractionType;
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
            'type' => [
                'required',
                'string',
                'in:' . implode(',', InteractionType::all()),
            ],
            'content' => [
                'nullable',
                'string',
            ],
            'contact' => [
                'required',
                'int',
                'exists:contacts,id'
            ],
            'project' => [
                'nullable',
                'int',
                'exists:projects,id',
            ],
            'user' => [
                'nullable',
                'int',
                'exists:users,id',
            ],
        ];
    }
}
