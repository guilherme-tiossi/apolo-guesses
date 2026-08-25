<?php

namespace Database\Seeders;

use App\Core\Domain\Shared\Enums\CharacterSubcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (CharacterSubcategory::cases() as $subcategory) {
            DB::table('subcategories')->updateOrInsert([
                'id' => $subcategory->value,
            ], [
                'category_id' => $subcategory->category()->value,
                'name' => $subcategory->label(),
            ]);
        }
    }
}
