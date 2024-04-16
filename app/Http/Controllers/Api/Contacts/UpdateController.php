<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Contacts;

use App\Models\Contact;
use Domains\Contacts\Actions\UpdateContact;
use Domains\Contacts\Factories\ContactFactory;
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
        $contact = Contact::query()
            ->where('uuid', $uuid)
            ->firstOrFail();

        $valueObject = ContactFactory::make(
            attributes: $request->validated(),
        );

        UpdateContact::handle(
            contact: $contact,
            attributes: $valueObject->toArray(),
        );

        return new JsonResponse(
            data: $contact->refresh(),
            status: 202,
        );
    }
}
