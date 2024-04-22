<?php

declare(strict_types=1);

namespace Domains\Interactions\Aggregates;

use Infrastructure\Contracts\ValueObjectContract;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use Domains\Interactions\Events\InteractionWasCreated;

class InteractionAggregateRoot extends AggregateRoot
{
    /**
     * @param ValueObjectContract $object
     * @return self
     */
    public function createInteraction(ValueObjectContract $object): self
    {
        $this->recordThat(
            domainEvent: new InteractionWasCreated(
                object: $object,
            ),
        );

        return $this;
    }
}