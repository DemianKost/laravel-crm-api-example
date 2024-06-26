<?php

declare(strict_types=1);

namespace Domains\Interactions\Factories;
use Domains\Interactions\ValueObjects\InteractionValueObject;

final class InteractionFactory
{
    /**
     * @param array attributes
     * @return InteractionValueObject
     */
    public static function make(array $attributes): InteractionValueObject
    {
        return new InteractionValueObject(
            type: $attributes['type'],
            contact: $attributes['contact'],
            user: $attributes['user'] ?? null,
            content: $attributes['content'] ?? null,
            project: $attributes['project'] ?? null,
        );
    }
}