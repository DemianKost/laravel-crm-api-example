<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;
use TiMacDonald\JsonApi\JsonApiResource;

class ContactResource extends JsonApiResource
{
    public function toType(Request $request): string
    {
        return 'contact';
    }

    /**
     * @param Request $request
     * @return array
     */
    public function toAttributes(Request $request): array
    {
        return [
            'title' => $this->title,
            'name' => [
                'first' => $this->first_name,
                'middle' => $this->middle_name,
                'last' => $this->last_name,
            ],
            'preferred' => $this->preferred_name,
            'full_name' => $this->fullName(),
            'phone' => $this->phone,
            'email' => $this->email,
            'pronoun' => $this->pronoun,
        ];
    }

    /**
     * @return string
     */
    protected function fullName(): string
    {
        return ltrim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }
}
