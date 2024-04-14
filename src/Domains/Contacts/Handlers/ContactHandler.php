<?php

declare(strict_types=1);

namespace Domains\Contacts\Handlers;

use Domains\Contacts\Actions\CreateNewContact;
use Domains\Contacts\Events\ContactWasCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class ContactHandler extends Projector
{
    /**
     * @param ContactWasCreated $event
     * @return void
     */
    public function onContactWasCreated(ContactWasCreated $event): void
    {
        CreateNewContact::handle(
            object: $event->object,
        );
    }
}