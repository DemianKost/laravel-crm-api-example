<?php

declare(strict_types=1);

namespace Domains\Interactions\Actions;

use App\Models\Interaction;
use Exception;

class UpdateInteraction
{
    /**
     * @param string $uuid
     * @param array $attributes
     * @return void
     */
    public static function handle(string $uuid, array $attributes): void
    {
        try {
            $interaction = Interaction::where('uuid', $uuid)->firstOrFail();

            $interaction->update(
                attributes: $attributes,
            );
        } catch ( Exception $exception ) {
            throw new Exception(
                message: 'Failed to update interaction',
                previous: $exception->getPrevious(),
            );
        }
    }
}