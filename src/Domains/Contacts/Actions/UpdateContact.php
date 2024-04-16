<?php

declare(strict_types=1);

namespace Domains\Contacts\Actions;
use App\Models\Contact;

final class UpdateContact
{
    public static function handle(Contact $contact, array $attributes): bool
    {
        return $contact->update(
            attributes: $attributes,
        );
    }
}