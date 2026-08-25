<?php

namespace Database\Seeders;

use App\Core\Domain\Shared\Enums\CharacterCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (CharacterCategory::cases() as $category) {
            DB::table('categories')->updateOrInsert([
                'id' => $category->value,
            ], [
                'name' => $category->label(),
            ]);
        }
    }
}
