<?php

declare(strict_types=1);

namespace Domains\Interactions\Events;

use Domains\Interactions\ValueObjects\InteractionValueObject;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class InteractionWasUpdated extends ShouldBeStored
{
    public function __construct(
        public InteractionValueObject $object,
        public string $uuid,
    ) {}
}