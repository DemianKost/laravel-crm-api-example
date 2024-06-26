<?php

declare(strict_types=1);

use App\Models\Contact;
use Domains\Contacts\Events\ContactWasCreated;
use Domains\Contacts\Events\ContactWasUpdated;
use Domains\Contacts\Factories\ContactFactory;
use Domains\Contacts\Enums\Pronouns;
use Domains\Contacts\Handlers\ContactHandler;

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

    expect(
        Contact::query()->count(),
    )->toEqual(0);

    (new ContactHandler())->onContactWasCreated(
        event: $event,
    );

    expect(
        Contact::query()->count(),
    )->toEqual(1);
})->with('strings');

it('can update existing contact by UUID', function(string $string) {
    $contact = Contact::factory()->create();

    $event = new ContactWasUpdated(
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
        uuid: $contact->uuid,
    );

    expect(
        $event,
    )->toBeInstanceOf(ContactWasUpdated::class);

    (new ContactHandler())->onContactWasUpdated(
        event: $event,
    );

    expect(
        $contact->refresh(),
    )->first_name->toEqual($string);
})->with('strings');