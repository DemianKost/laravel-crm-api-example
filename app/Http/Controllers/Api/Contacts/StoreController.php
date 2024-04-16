<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use Domains\Contacts\Aggregates\ContactAggregateRoot;
use Domains\Contacts\Factories\ContactFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Contacts\StoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function __invoke(StoreRequest $request): JsonResponse
    {
        ContactAggregateRoot::retrieve(
            uuid: Str::uuid()->toString(),
        )->createContact(
            object: ContactFactory::make(
                attributes: $request->validated(),
            ),
        )->persist();

        return new JsonResponse(
            data: null,
            status: 202
        );
    }
}
