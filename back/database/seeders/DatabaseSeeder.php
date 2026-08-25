<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            SubcategorySeeder::class,
            AttributeSeeder::class,
            AttributeOppositionSeeder::class,
            CharacterSeeder::class,
            CharacterAttributeSeeder::class,
        ]);
    }
}
