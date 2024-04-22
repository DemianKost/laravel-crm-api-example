<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interactions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\InteractionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            data: InteractionResource::collection(
                resource: auth()->user()->interactions,
            ),
            status: 200,
        );
    }
}
