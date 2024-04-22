<?php

declare(strict_types=1);

use App\Models\Contact;
use App\Models\Interaction;
use Domains\Interactions\Enums\InteractionType;
use Domains\Interactions\Events\InteractionWasCreated;
use Domains\Interactions\Factories\InteractionFactory;
use Domains\Interactions\Handlers\InteractionHandler;

it( 'can store a new interaction', function() {
    $event = new InteractionWasCreated(
        object: InteractionFactory::make(
            attributes: [
                'type' => InteractionType::EMAIL->value,
                'contact' => Contact::factory()->create()->id,
                'content' => 'Some content',
                'user' => null,
                'project' => null,
            ],
        ),
    );

    expect(
        $event,
    )->toBeInstanceOf( class: InteractionWasCreated::class );

    expect(
        Interaction::query()->count(),
    )->toEqual(0);

    (new InteractionHandler())->onInteractionWasCreated(
        event: $event,
    );

    expect(
        Interaction::query()->count(),
    )->toEqual(1);
} );