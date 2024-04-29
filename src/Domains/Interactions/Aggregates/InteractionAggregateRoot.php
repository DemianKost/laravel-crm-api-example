<?php

declare(strict_types=1);

namespace Domains\Interactions\Aggregates;

use Domains\Interactions\Events\InteractionWasDeleted;
use Domains\Interactions\Events\InteractionWasUpdated;
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

    /**
     * @param ValueObjectContract $object
     * @param string $uuid
     * @return self
     */
    public function updateInteraction(ValueObjectContract $object, string $uuid): self
    {
        $this->recordThat(
            domainEvent: new InteractionWasUpdated(
                object: $object,
                uuid: $uuid,
            ),
        );

        return $this;
    }

    /**
     * @param string $uuid
     * @return self
     */
    public function deleteInteraction(string $uuid): self
    {
        $this->recordThat(
            domainEvent: new InteractionWasDeleted(
                uuid: $uuid,
            ),
        );

        return $this;
    }
}