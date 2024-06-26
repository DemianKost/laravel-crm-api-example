<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ContactSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        if ( app()->environment(['local']) ) {
            $this->call(
                class: [
                    ContactSeeder::class,
                ],
            );
        }
    }
}
