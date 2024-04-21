<?php

declare(strict_types=1);

namespace Domains\Interactions\Factories;
use Domains\Interactions\ValueObjects\InteractionValueObject;

final class InteractionFactory
{
    /**
     * @param array attributes
     */
    public static function make(array $attributes): InteractionValueObject
    {
        return new InteractionValueObject(
            type: $attributes['type'],
            contact: $attributes['contact'],
            content: $attributes['content'],
            project: $attributes['project'],
        );
    }
}