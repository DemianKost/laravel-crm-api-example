<?php

declare(strict_types=1);

use Domains\Contacts\Events\ContactWasCreated;
use Domains\Contacts\Factories\ContactFactory;
use Domains\Contacts\Enums\Pronouns;

it('can store a new contact', function(string $string) {
    $event = new ContactWasCreated(
        object: ContactFactory::make(
            attributes: [
                'title' => $string,
                'name' => [
                    'first' => $string,
                    'middle' => $string,
                    'last' => $string,
                    'preferred' => $string,
                    'full' => "$string $string $string",
                ],
                'phone' => $string,
                'email' => "$string@email.com",
                'pronous' => Pronouns::random(),
            ],
        ),
    );

    expect(
        $event,
    )->toBeInstanceOf(ContactWasCreated::class);
})->with('strings');