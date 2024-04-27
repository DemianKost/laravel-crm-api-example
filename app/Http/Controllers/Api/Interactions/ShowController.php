<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interactions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\InteractionResource;
use App\Models\Interaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ShowController extends Controller
{
    /**
     * @param Request $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function __invoke(Request $request, string $uuid): JsonResponse
    {
        $interaction = QueryBuilder::for(
            subject: Interaction::class,
        )->where('uuid', $uuid)->firstOrFail();

        return new JsonResponse(
            data: new InteractionResource(
                resource: $interaction,
            ),
            status: 200
        );
    }
}
