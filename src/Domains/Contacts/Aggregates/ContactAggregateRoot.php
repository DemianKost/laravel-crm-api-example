<?php

declare(strict_types=1);

namespace Domains\Contacts\Aggregates;

use Domains\Contacts\Events\ContactWasUpdated;
use Infrastructure\Contracts\ValueObjectContract;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;
use Domains\Contacts\Events\ContactWasCreated;

class ContactAggregateRoot extends AggregateRoot
{
    /**
     * @param ValueObjectContract $object
     * @return self
     */
    public function createContact(ValueObjectContract $object): self
    {
        $this->recordThat(
            domainEvent: new ContactWasCreated(
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
    public function updateContact(ValueObjectContract $object, string $uuid): self
    {
        $this->recordThat(
            domainEvent: new ContactWasUpdated(
                object: $object,
                uuid: $uuid,
            ),
        );
        

        return $this;
    }
}