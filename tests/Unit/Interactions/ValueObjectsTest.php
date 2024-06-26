<?php

declare(strict_types=1);

use Domains\Interactions\Enums\InteractionType;
use Domains\Interactions\Factories\InteractionFactory;
use Domains\Interactions\ValueObjects\InteractionValueObject;

it( 'can create a new interaction value object', function( string $string ) {
    expect(
        new InteractionValueObject(
            type: InteractionType::EMAIL->value,
            contact: 1,
            user: 1,
            content: $string,
        ),
    )->toBeInstanceOf(InteractionValueObject::class);
})->with('strings');

it( 'can create a new interaction value object via interaction factory', function( string $string ) {
    expect(
        value: InteractionFactory::make(
            attributes: [
                'type' => InteractionType::EMAIL->value,
                'contact' => 1,
                'user' => 1,
                'content' => $string,
            ]
        ),
    )->toBeInstanceOf(InteractionValueObject::class);
})->with('strings');