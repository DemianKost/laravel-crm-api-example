<?php

declare(strict_types=1);

use App\Models\Contact;
use Domains\Contacts\Actions\CreateNewContact;
use Domains\Contacts\Actions\UpdateContact;
use Domains\Contacts\Enums\Pronouns;
use Domains\Contacts\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

it( 'can create a new contact', function(string $string) {
    expect(
        CreateNewContact::handle(
            object: ContactFactory::make(
                attributes: [
                    'title' => $string,
                    'name' => [
                        'first' => $string,
                        'middle' => $string,
                        'last' => $string,
                        'preferred' => $string,
                        'full' => "$string $string $string"
                    ],
                    'phone' => $string,
                    'email' => "{$string}@gmail.com",
                    'pronouns' => Pronouns::random(),
                ],
            ),
        )
    )->toBeInstanceOf(Model::class)->phone->toEqual($string);
})->with('strings');

it( 'can update existing contact by UUID', function(string $string) {
    $contact = Contact::factory()->create();

    UpdateContact::handle(
        uuid: $contact->uuid,
        attributes: [
            'title' => $string,
            'name' => [
                'first' => $string,
                'middle' => $string,
                'last' => $string,
                'preferred' => $string,
                'full' => "$string $string $string"
            ],
            'phone' => $string,
            'email' => "{$string}@gmail.com",
        ],
    );

    expect(
        $contact->refresh(),
    )->phone->toEqual($string);
})->with('strings');

it( 'throws an exception when trying to update contact that does not exists', function(string $uuid) {
    UpdateContact::handle(
        uuid: $uuid,
        attributes: [
            'title' => $uuid,
        ],
    );
})->with('uuids')->throws( exception: ModelNotFoundException::class );