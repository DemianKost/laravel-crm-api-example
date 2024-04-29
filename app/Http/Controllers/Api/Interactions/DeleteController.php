<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interactions;

use App\Http\Controllers\Controller;
use App\Models\Interaction;
use Domains\Interactions\Aggregates\InteractionAggregateRoot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeleteController extends Controller
{
    /**
     * @param Request $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function __invoke(Request $request, string $uuid): JsonResponse
    {
        InteractionAggregateRoot::retrieve(
            uuid: Str::uuid()->toString(),
        )->deleteInteraction(
            uuid: $uuid,
        )->persist();

        return new JsonResponse(
            data: null,
            status: 200,
        );
    }
}