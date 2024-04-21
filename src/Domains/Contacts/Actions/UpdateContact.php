<?php

declare(strict_types=1);

namespace Domains\Contacts\Actions;

use App\Models\Contact;
use Domains\Contacts\Exceptions\ContactUpdateException;

final class UpdateContact
{
    /**
     * @param string $uuid
     * @param array $attributes
     * @throws ContactUpdateException
     * @return void
     */
    public static function handle(string $uuid, array $attributes): void
    {
        try {
            $contact = Contact::where('uuid', $uuid)->firstOrFail();
            
            $contact->update(
                attributes: $attributes
            );
        } catch ( ContactUpdateException $exception ) {
            throw new ContactUpdateException(
                message: "Failed to update contact with UUID: $uuid",
                previous: $exception->getPrevious(),
            );
        }
    }
}