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
            CharacterCategorySeeder::class,
            AttributeGroupSeeder::class,
            AttributeSubgroupSeeder::class,
            AttributeSeeder::class,
            AttributeOppositionSeeder::class,
            CharacterSeeder::class,
            CharacterAttributeSeeder::class,
        ]);
    }
}
