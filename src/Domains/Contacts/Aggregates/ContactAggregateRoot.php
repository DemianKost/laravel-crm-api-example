<?php

declare(strict_types=1);

namespace Domains\Contacts\Aggregates;
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
}