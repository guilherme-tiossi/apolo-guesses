<?php

namespace Database\Seeders;

use App\Core\Domain\Enums\AttributeSubgroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSubgroupSeeder extends Seeder
{
    public function run(): void
    {
        foreach (AttributeSubgroup::cases() as $subgroup) {
            DB::table('attribute_subgroups')->updateOrInsert([
                'id' => $subgroup->value,
            ], [
                'name' => $subgroup->label(),
                'attribute_group_id' => $subgroup->group()->value,
            ]);
        }
    }
}
