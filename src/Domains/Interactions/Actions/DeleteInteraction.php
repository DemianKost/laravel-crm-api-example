<?php

declare(strict_types=1);

namespace Domains\Interactions\Actions;

use App\Models\Interaction;

class DeleteInteraction
{
    /**
     * @param string $uuid
     * @return void
     */
    public static function handle(string $uuid): void
    {
        $interaction = Interaction::where('uuid', $uuid)->firstOrFail();

        $interaction->delete();
    }
}