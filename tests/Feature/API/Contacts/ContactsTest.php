<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

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

it( 'it can create a new contact', function(string $string) {
    expect(Contact::query()->count())->toEqual(0);

    // $this->postJson(
    //     uri: route(''),
    // )
})->with('strings');