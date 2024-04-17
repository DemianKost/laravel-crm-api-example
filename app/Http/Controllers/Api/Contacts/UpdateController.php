<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Requests\Api\Contacts\UpdateRequest;
use App\Models\Contact;
use Domains\Contacts\Actions\UpdateContact;
use Domains\Contacts\Aggregates\ContactAggregateRoot;
use Domains\Contacts\Factories\ContactFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UpdateController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function __invoke(UpdateRequest $request, string $uuid): JsonResponse
    {
        $contact = Contact::query()
            ->where('uuid', $uuid)
            ->firstOrFail();

        ContactAggregateRoot::retrieve(
            uuid: $uuid,
        )->updateContact(
            object: ContactFactory::make(
                attributes: $request->validated(),
            ),
            uuid: $uuid
        )->persist();

        return new JsonResponse(
            data: null,
            status: 202,
        );
    }
}
