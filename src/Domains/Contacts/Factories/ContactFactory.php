<?php

declare(strict_types=1);

namespace Domains\Contacts\Factories;

use Domains\Contacts\ValueObjects\ContactValueObject;

final class ContactFactory
{
    /**
     * @param array<string, string> $attributes
     * @return ContactValueObject
     */
    public static function make(array $attributes): ContactValueObject
    {
        return new ContactValueObject(
            title: strval(data_get($attributes, 'title')),
            firstName: strval(data_get($attributes, 'name.first')),
            middleName: strval(data_get($attributes, 'name.middle')),
            lastName: strval(data_get($attributes, 'name.last')),
            prefferedName: strval(data_get($attributes, 'name.preffered')),
            phone: strval(data_get($attributes, 'phone')),
            email: strval(data_get($attributes, 'email')),
            pronouns: strval(data_get($attributes, 'pronouns')),
        );
    }
}