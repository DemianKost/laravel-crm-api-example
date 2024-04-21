<?php

declare(strict_types=1);

namespace Domains\Contacts\Events;
use Domains\Contacts\ValueObjects\ContactValueObject;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

final class ContactWasCreated extends ShouldBeStored
{
    /**
     * @param ContactValueObject $object
     */
    public function __construct(
        public ContactValueObject $object
    ) {}
}