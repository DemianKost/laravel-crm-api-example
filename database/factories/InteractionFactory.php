<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Domains\Interactions\Enums\InteractionType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interaction>
 */
class InteractionFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => Arr::random(
                array: [
                    InteractionType::EMAIL,
                    InteractionType::PHONE,
                    InteractionType::MEETING,
                ],
            ),
            'content' => $this->faker->paragraph(3, true),
            'user_id' => User::factory(),
            'contact_id' => Contact::factory(),
        ];
    }
}
