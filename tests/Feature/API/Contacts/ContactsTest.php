<?php

declare(strict_types=1);

use App\Enums\Pronouns;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

it( 'gets an unathorized response when not logged in on the index', function() {
    $this->getJson(
        uri: route('api:contacts:index')
    )->assertStatus(
        status: 401
    );
});

it( 'it can retrieve a list of contacts', function() {
    auth()->loginUsingId(User::factory()->create()->id);

    Contact::factory(10)->create();

    $this->getJson(
        uri: route('api:contacts:index'),
    )->assertStatus(
        status: 200,
    )->assertJson( fn (AssertableJson $json) =>
        $json->count(10)
            ->first( fn (AssertableJson $json) =>
                $json->where('type', 'contact')->etc(),
            ),
    );
});

it( 'gets and Unauthorized response when not logged in on the create route', function(string $string) {
    $this->postJson(
        uri: route('api:contacts:store'),
        data: [
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
    )->assertStatus(
        status: 401
    );
} )->with('strings');

it( 'it can create a new contact', function(string $string) {
    auth()->loginUsingId(User::factory()->create()->id);

    expect(Contact::query()->count())->toEqual(0);

    $this->postJson(
        uri: route('api:contacts:store'),
        data: [
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
    )->assertStatus(
        status: 201,
    )->assertJson( fn (AssertableJson $json) =>
        $json
            ->where('type', 'contact')
            ->where('attributes.name.first', $string)
            ->where('attributes.phone', $string)
            ->etc()
    );

    expect(Contact::query()->count())->toEqual(1);
})->with('strings');

it( 'can retrieve contact by UUID', function() {
    auth()->loginUsingId(User::factory()->create()->id);

    $contact = Contact::factory()->create();

    $this->getJson(
        uri: route('api:contacts:show', $contact->uuid),
    )->assertStatus(
        status: 200
    )->assertJson( fn (AssertableJson $json) =>
            $json
                ->where('type', 'contact')
                ->where('attributes.name.first', $contact->first_name)
                ->where('attributes.name.last', $contact->last_name)
                ->where('attributes.phone', $contact->phone)
                ->etc(),
    );
});