<?php

namespace Database\Seeders;

use App\Core\Domain\Attributes\Interfaces\Attribute;
use App\Core\Domain\Attributes\Services\AttributeOppositionPolicy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeOppositionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (AttributeOppositionPolicy::allPairs() as [$first, $second]) {
            $this->seedPair($first, $second);
            $this->seedPair($second, $first);
        }
    }

    private function seedPair(Attribute $first, Attribute $second): void
    {
        $attributeId = $this->attributeId($first);
        $oppositeAttributeId = $this->attributeId($second);

        DB::table('attribute_oppositions')->updateOrInsert(
            [
                'attribute_id' => $attributeId,
                'opposite_attribute_id' => $oppositeAttributeId,
            ],
            []
        );
    }

    private function attributeId(Attribute $attribute): int
    {
        return DB::table('attributes')->where('internal_name', $attribute->value)->value('id');
    }
}
