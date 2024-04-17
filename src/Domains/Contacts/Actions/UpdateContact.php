<?php

declare(strict_types=1);

namespace Domains\Contacts\Actions;
use App\Models\Contact;

final class UpdateContact
{
    public static function handle(string $uuid, array $attributes): bool
    {
        $contact = Contact::where('uuid', $uuid)->firstOrFail();

        return $contact->update(
            attributes: $attributes,
        );
    }
}