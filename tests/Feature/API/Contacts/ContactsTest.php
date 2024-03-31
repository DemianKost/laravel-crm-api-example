<?php

declare(strict_types=1);

use JustSteveKing\StatusCode\Http;

it( 'it can retrieve a list of contacts', function() {
    $this->getJson(
        uri: route('api:contacts:index'),
    )->assertStatus(
        status: Http::OK,
    );
});