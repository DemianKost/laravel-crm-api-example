<?php

declare(strict_types=1);

namespace Domains\Interactions\Handlers;

use Domains\Interactions\Actions\CreateInteraction;
use Domains\Interactions\Events\InteractionWasCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class InteractionHandler extends Projector
{
    /**
     * @param InteractionWasCreated $event
     * @return void
     */
    public function onInteractionWasCreated(InteractionWasCreated $event): void
    {
        CreateInteraction::handle(
            object: $event->object,
        );
    }
}