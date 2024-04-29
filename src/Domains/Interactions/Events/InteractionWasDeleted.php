<?php

declare(strict_types=1);

namespace Domains\Interactions\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class InteractionWasDeleted extends ShouldBeStored
{
    /**
     * @param string $uuid
     */
    public function __construct(
        public string $uuid,
    ) {}
}