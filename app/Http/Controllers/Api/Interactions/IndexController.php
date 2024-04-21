<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interactions;

use App\Http\Controllers\Controller;
use App\Models\Interaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $interactions = QueryBuilder::for(
            subject: Interaction::class,
        )->paginate();

        return new JsonResponse(
            data: [],
            status: 200,
        );
    }
}
