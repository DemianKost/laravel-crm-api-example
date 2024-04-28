<?php

declare(strict_types=1);

use App\Models\Interaction;
use App\Models\User;
use App\Models\Contact;
use Domains\Interactions\Enums\InteractionType;
use Illuminate\Testing\Fluent\AssertableJson;

it('can get a list of interactions', function() {
    $user = User::factory()->create();
    auth()->login( $user );

    Interaction::factory(10)->create(
        attributes: [ 'user_id' => $user->id ],
    );

    $this->getJson(
        uri: route('api:interactions:index'),
    )->assertStatus(
        status: 200,
    )->assertJson(
        fn( AssertableJson $json ) => 
            $json->count(10)->etc(),
    );
});

it('can create a new interaction', function() {
    $user = User::factory()->create();
    auth()->login( $user );

    expect(Interaction::query()->count())->toEqual(0);

    $this->postJson(
        uri: route('api:interactions:store'),
        data: [
            'type' => InteractionType::EMAIL->value,
            'contact' => Contact::factory()->create()->id,
            'content' => 'some content here',
        ],
    )->assertStatus(
        status: 201,
    );

    // expect(Interaction::query()->count())->toEqual(1);
});

it('can get a single interaction by uuid', function() {
    $user = User::factory()->create();
    auth()->login( $user );

    $interaction = Interaction::factory()->create();

    $this->getJson(
        route('api:interactions:show', $interaction->uuid)
    )->assertStatus(
        status: 200,
    )->assertJson(
        value: fn( AssertableJson $json ) => 
            $json->where('type', 'interaction')
                ->where('attributes.content', $interaction->content)
                ->etc(),
    );
});

it('throws 404 error when trying to get non-existing interaction', function(string $uuid) {
    $user = User::factory()->create();
    auth()->login( $user );

    $this->getJson(
        uri: route('api:interactions:show', $uuid)
    )->assertStatus(
        status: 404,
    );
})->with('uuids');

it('can update a single interaction uuid', function(string $string) {
    $user = User::factory()->create();
    auth()->login( $user );

    $interaction = Interaction::factory()->create([
        'user_id' => $user->id,
    ]);

    $this->putJson(
        uri: route('api:interactions:update', $interaction->uuid),
        data: [
            'type' => InteractionType::EMAIL->value,
            'contact' => $interaction->contact_id,
            'content' => $string,
        ],
    )->assertStatus(
        status: 202,
    );

    expect(
        $interaction->refresh()
    )->content->toEqual($string);
})->with('strings');