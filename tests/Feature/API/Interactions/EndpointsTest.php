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
            'user' => null,
            'project' => null,
        ],
    )->assertStatus(
        status: 201,
    );

    expect(Interaction::query()->count())->toEqual(1);
});