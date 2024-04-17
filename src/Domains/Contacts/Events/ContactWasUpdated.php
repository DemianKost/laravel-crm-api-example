<?php

declare(strict_types=1);

namespace Domains\Contacts\Events;
use Domains\Contacts\ValueObjects\ContactValueObject;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ContactWasUpdated extends ShouldBeStored
{
    public function __construct(
        public ContactValueObject $object,
        public string $uuid,
    ) {}
}