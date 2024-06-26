<?php

declare(strict_types=1);

namespace Domains\Interactions\Events;

use Domains\Interactions\ValueObjects\InteractionValueObject;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class InteractionWasCreated extends ShouldBeStored
{
    public function __construct(
        public InteractionValueObject $object,
    ) {}
}