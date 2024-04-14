<?php

declare(strict_types=1);

namespace App\Actions\Contacts;
use App\Contracts\ValueObjectContract;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;

final class UpdateContact
{
    public static function handle(ValueObjectContract $object): Model
    {
        return Contact::query()->create(
            attributes: $object->toArray(),
        );
    }
}