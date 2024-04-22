<?php

declare(strict_types=1);

namespace Domains\Interactions\Actions;

use App\Models\Interaction;
use Domains\Interactions\ValueObjects\InteractionValueObject;
use Illuminate\Database\Eloquent\Model;

class CreateInteraction
{
    /**
     * @param InteractionValueObject $object
     * @return Model
     */
    public static function handle(InteractionValueObject $object): Model
    {
        return Interaction::query()->create(
            attributes: $object->toArray(),
        );
    }
}