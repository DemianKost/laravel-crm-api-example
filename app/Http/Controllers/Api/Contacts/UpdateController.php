<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Actions\Contacts\UpdateContact;
use App\Factories\ContactFactory;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ContactResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke(Request $request, string $uuid): JsonResponse
    {
        $contact = UpdateContact::handle(
            object: ContactFactory::make(
                attributes: $request->validated(),
            ),
        );

        return new JsonResponse(
            data: new ContactResource(
                resource: $contact
            ),
            status: 202,
        );
    }
}
