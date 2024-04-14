<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Actions\Contacts\CreateNewContact;
use Domains\Contacts\Factories\ContactFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Contacts\StoreRequest;
use App\Http\Resources\Api\ContactResource;
use Illuminate\Http\JsonResponse;

class StoreController extends Controller
{
    /**
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function __invoke(StoreRequest $request): JsonResponse
    {
        $contact = CreateNewContact::handle(
            object: ContactFactory::make(
                attributes: $request->validated()
            )
        );

        return new JsonResponse(
            data: new ContactResource(
                resource: $contact,
            ),
            status: 201
        );
    }
}
