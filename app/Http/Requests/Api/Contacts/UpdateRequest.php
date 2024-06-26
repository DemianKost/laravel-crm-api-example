<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Contacts;

use Domains\Contacts\Enums\Pronouns;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
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
            'title' => ['nullable', 'string', 'max:20'],
            'name.first' => ['required', 'string', 'min:2', 'max:82'],
            'name.middle' => ['nullable', 'string', 'min:2', 'max:82'],
            'name.last' => ['nullable', 'string', 'min:2', 'max:82'],
            'name.preferred' => ['nullable', 'string', 'min:2', 'max:82'],
            'name.full' => ['required', 'string', 'min:2', 'max:255'],
            'phone' => ['nullable', 'string'],
            'email' => ['nullable', 'email:rfc,dns'],
            'pronouns' => ['nullable', 'string', Rule::in(values: Pronouns::all())],
        ];
    }
}
