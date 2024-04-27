<?php

declare(strict_types=1);

use App\Models\Contact;

use Domains\Interactions\Actions\CreateInteraction;
use Domains\Interactions\Enums\InteractionType;
use Domains\Interactions\Factories\InteractionFactory;
use Illuminate\Database\Eloquent\Model;

it( 'action can create a new interaction', function() {
    expect(
        CreateInteraction::handle(
            object: InteractionFactory::make(
                attributes: [
                    'type' => InteractionType::EMAIL->value,
                    'contact' => Contact::factory()->create()->id,
                ],
            ),
        ),
    )->toBeInstanceOf(Model::class)->type->toEqual(InteractionType::EMAIL);
});