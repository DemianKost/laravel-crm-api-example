<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Interactions\UpdateRequest;
use App\Models\Interaction;
use Domains\Interactions\Aggregates\InteractionAggregateRoot;
use Domains\Interactions\Factories\InteractionFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class UpdateController extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, string $uuid): JsonResponse
    {
        $interaction = Interaction::query()
            ->where('uuid', $uuid)
            ->firstOrFail();

        InteractionAggregateRoot::retrieve(
            uuid: Str::uuid()->toString(),
        )->updateInteraction(
            object: InteractionFactory::make(
                attributes: array_merge(
                    $request->validated(),
                    ['user' => auth()->id()]
                ),
            ),
            uuid: $uuid,
        )->persist();

        return new JsonResponse(
            data: null,
            status: 202,
        );
    }
}
