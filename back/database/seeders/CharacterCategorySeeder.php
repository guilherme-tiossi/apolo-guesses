<?php

namespace Database\Seeders;

use App\Core\Domain\Enums\CharacterCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (CharacterCategory::cases() as $category) {
            DB::table('character_categories')->updateOrInsert([
                'id' => $category->value,
            ], [
                'name' => $category->label(),
            ]);
        }
    }
}
