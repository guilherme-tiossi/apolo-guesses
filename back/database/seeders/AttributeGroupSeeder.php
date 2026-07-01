<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeGroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            1 => 'appearance',
            2 => 'identity',
            4 => 'personality',
            5 => 'career',
            9 => 'sports',
            10 => 'entertainment',
            12 => 'hobbies',
            14 => 'accomplishments',
            16 => 'history',
            17 => 'geography',
            18 => 'technology',
            19 => 'fiction',
            20 => 'powers',
            24 => 'miscellaneous',
        ];

        foreach ($groups as $id => $name) {
            DB::table('attribute_groups')->updateOrInsert([
                'id' => $id,
            ], [
                'name' => $name,
            ]);
        }
    }
}
