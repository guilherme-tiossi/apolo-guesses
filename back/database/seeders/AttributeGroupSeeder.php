<?php

namespace Database\Seeders;

use App\Core\Domain\Attributes\Enums\AttributeGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeGroupSeeder extends Seeder
{
    public function run(): void
    {
        foreach (AttributeGroup::cases() as $group) {
            DB::table('attribute_groups')->updateOrInsert([
                'id' => $group->value,
            ], [
                'name' => $group->label(),
            ]);
        }
    }
}
