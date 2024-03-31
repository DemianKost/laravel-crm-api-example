<?php

declare(strict_types=1);

use App\Models\User;

it( 'it can retrieve a list of contacts', function() {
    auth()->loginUsingId(User::factory()->create()->id);

    $this->getJson(
        uri: route('api:contacts:index'),
    )->assertStatus(
        status: 200,
    );
});