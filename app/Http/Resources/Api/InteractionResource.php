<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

class InteractionResource extends JsonApiResource
{
    public function toType(Request $request): string
    {
        return 'interaction';
    }

    /**
     * @param Request $request
     * @return array
     */
    public function toAttributes(Request $request): array
    {
        return [
            'type' => $this->type,
            'content' => $this->content,
        ];
    }
}
