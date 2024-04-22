<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Interactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        

        return new JsonResponse(
            data: null,
            status: 201
        );
    }
}
