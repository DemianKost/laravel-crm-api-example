<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Interactions\StoreRequest;
use Domains\Interactions\Aggregates\InteractionAggregateRoot;
use Domains\Interactions\Factories\InteractionFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): JsonResponse
    {
        InteractionAggregateRoot::retrieve(
            uuid: Str::uuid()->toString(),
        )->createInteraction(
            object: InteractionFactory::make(
                attributes: $request->validated(),
            ),
        );

        return new JsonResponse(
            data: null,
            status: 201
        );
    }
}
