<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSubgroupSeeder extends Seeder
{
    public function run(): void
    {
        $this->appearance();
        $this->identity();
        $this->personality();
        $this->career();
        $this->sports();
        $this->entertainment();
        $this->hobbies();
        $this->accomplishments();
        $this->history();
        $this->geography();
        $this->technology();
        $this->fiction();
        $this->powers();
        $this->miscellaneous();
    }

    private function seed(array $subgroups): void
    {
        foreach ($subgroups as $subgroup) {
            DB::table('attribute_subgroups')->updateOrInsert([
                'id' => $subgroup['id'],
            ], [
                'name' => $subgroup['name'],
                'attribute_group_id' => $subgroup['attribute_group_id'],
            ]);
        }
    }

    private function appearance(): void
    {
        $this->seed([
            ['id' => 1, 'name' => 'height', 'attribute_group_id' => 1],
            ['id' => 2, 'name' => 'weight', 'attribute_group_id' => 1],
            ['id' => 3, 'name' => 'build', 'attribute_group_id' => 1],
            ['id' => 4, 'name' => 'skin_color', 'attribute_group_id' => 1],
            ['id' => 5, 'name' => 'hair_color', 'attribute_group_id' => 1],
            ['id' => 6, 'name' => 'hair_length', 'attribute_group_id' => 1],
            ['id' => 7, 'name' => 'hair_style', 'attribute_group_id' => 1],
            ['id' => 8, 'name' => 'hair_texture', 'attribute_group_id' => 1],
            ['id' => 9, 'name' => 'facial_hair', 'attribute_group_id' => 1],
            ['id' => 10, 'name' => 'eye_color', 'attribute_group_id' => 1],
            ['id' => 11, 'name' => 'facial_features', 'attribute_group_id' => 1],
            ['id' => 12, 'name' => 'species', 'attribute_group_id' => 1],
            ['id' => 18, 'name' => 'style', 'attribute_group_id' => 1],
            ['id' => 19, 'name' => 'disabilities', 'attribute_group_id' => 1],
            ['id' => 20, 'name' => 'distinctive_features', 'attribute_group_id' => 1],
        ]);
    }

    private function identity(): void
    {
        $this->seed([
            ['id' => 23, 'name' => 'age', 'attribute_group_id' => 2],
            ['id' => 24, 'name' => 'gender', 'attribute_group_id' => 2],
            ['id' => 25, 'name' => 'sexual_orientation', 'attribute_group_id' => 2],
            ['id' => 26, 'name' => 'nationality', 'attribute_group_id' => 2],
            ['id' => 27, 'name' => 'ethnicity', 'attribute_group_id' => 2],
            ['id' => 29, 'name' => 'languages', 'attribute_group_id' => 2],
            ['id' => 30, 'name' => 'titles', 'attribute_group_id' => 2],
            ['id' => 31, 'name' => 'living_status', 'attribute_group_id' => 2],
            ['id' => 32, 'name' => 'birth_origin', 'attribute_group_id' => 2],
            ['id' => 34, 'name' => 'religion', 'attribute_group_id' => 2],
            ['id' => 35, 'name' => 'family', 'attribute_group_id' => 2],
            ['id' => 36, 'name' => 'political_profile', 'attribute_group_id' => 2],
            ['id' => 37, 'name' => 'education', 'attribute_group_id' => 2],
        ]);
    }

    private function personality(): void
    {
        $this->seed([
            ['id' => 43, 'name' => 'temperament', 'attribute_group_id' => 4],
            ['id' => 44, 'name' => 'intelligence', 'attribute_group_id' => 4],
            ['id' => 45, 'name' => 'humor', 'attribute_group_id' => 4],
            ['id' => 46, 'name' => 'leadership', 'attribute_group_id' => 4],
            ['id' => 47, 'name' => 'morality', 'attribute_group_id' => 4],
            ['id' => 49, 'name' => 'emotions', 'attribute_group_id' => 4],
            ['id' => 50, 'name' => 'habits', 'attribute_group_id' => 4],
            ['id' => 51, 'name' => 'lifestyle', 'attribute_group_id' => 4],
            ['id' => 52, 'name' => 'beliefs', 'attribute_group_id' => 4],
            ['id' => 53, 'name' => 'health', 'attribute_group_id' => 4],
        ]);
    }

    private function career(): void
    {
        $this->seed([
            ['id' => 53, 'name' => 'profession', 'attribute_group_id' => 5],
            ['id' => 54, 'name' => 'industry', 'attribute_group_id' => 5],
            ['id' => 55, 'name' => 'arts', 'attribute_group_id' => 5],
            ['id' => 56, 'name' => 'science', 'attribute_group_id' => 5],
            ['id' => 57, 'name' => 'business', 'attribute_group_id' => 5],
            ['id' => 58, 'name' => 'medicine', 'attribute_group_id' => 5],
            ['id' => 59, 'name' => 'law', 'attribute_group_id' => 5],
            ['id' => 60, 'name' => 'media', 'attribute_group_id' => 5],
            ['id' => 61, 'name' => 'public_service', 'attribute_group_id' => 5],
            ['id' => 62, 'name' => 'military_career', 'attribute_group_id' => 5],
        ]);
    }

    private function sports(): void
    {
        $this->seed([
            ['id' => 80, 'name' => 'football', 'attribute_group_id' => 9],
            ['id' => 81, 'name' => 'basketball', 'attribute_group_id' => 9],
            ['id' => 82, 'name' => 'other_sports', 'attribute_group_id' => 9],
            ['id' => 85, 'name' => 'combat_sports', 'attribute_group_id' => 9],
            ['id' => 88, 'name' => 'esports', 'attribute_group_id' => 9],
            ['id' => 89, 'name' => 'sport_roles', 'attribute_group_id' => 9],
        ]);
    }

    private function entertainment(): void
    {
        $this->seed([
            ['id' => 90, 'name' => 'movies', 'attribute_group_id' => 10],
            ['id' => 91, 'name' => 'television', 'attribute_group_id' => 10],
            ['id' => 92, 'name' => 'music', 'attribute_group_id' => 10],
            ['id' => 93, 'name' => 'theater', 'attribute_group_id' => 10],
            ['id' => 94, 'name' => 'literature', 'attribute_group_id' => 10],
            ['id' => 95, 'name' => 'comics', 'attribute_group_id' => 10],
            ['id' => 96, 'name' => 'anime_manga', 'attribute_group_id' => 10],
            ['id' => 97, 'name' => 'streaming', 'attribute_group_id' => 10],
            ['id' => 98, 'name' => 'social_media', 'attribute_group_id' => 10],
        ]);
    }

    private function hobbies(): void
    {
        $this->seed([
            ['id' => 105, 'name' => 'arts_and_crafts', 'attribute_group_id' => 12],
            ['id' => 106, 'name' => 'collecting', 'attribute_group_id' => 12],
            ['id' => 107, 'name' => 'travel', 'attribute_group_id' => 12],
            ['id' => 108, 'name' => 'reading', 'attribute_group_id' => 12],
            ['id' => 109, 'name' => 'gaming', 'attribute_group_id' => 12],
            ['id' => 110, 'name' => 'cooking', 'attribute_group_id' => 12],
            ['id' => 111, 'name' => 'gardening', 'attribute_group_id' => 12],
            ['id' => 112, 'name' => 'fitness', 'attribute_group_id' => 12],
            ['id' => 113, 'name' => 'outdoor_activities', 'attribute_group_id' => 12],
        ]);
    }

    private function accomplishments(): void
    {
        $this->seed([
            ['id' => 124, 'name' => 'awards', 'attribute_group_id' => 14],
            ['id' => 125, 'name' => 'records', 'attribute_group_id' => 14],
            ['id' => 126, 'name' => 'titles', 'attribute_group_id' => 14],
            ['id' => 127, 'name' => 'certifications', 'attribute_group_id' => 14],
            ['id' => 128, 'name' => 'recognition', 'attribute_group_id' => 14],
        ]);
    }

    private function history(): void
    {
        $this->seed([
            ['id' => 129, 'name' => 'historical_period', 'attribute_group_id' => 16],
            ['id' => 130, 'name' => 'historical_event', 'attribute_group_id' => 16],
            ['id' => 131, 'name' => 'historical_role', 'attribute_group_id' => 16],
            ['id' => 132, 'name' => 'historical_impact', 'attribute_group_id' => 16],
        ]);
    }

    private function geography(): void
    {
        $this->seed([
            ['id' => 133, 'name' => 'continent', 'attribute_group_id' => 17],
            ['id' => 134, 'name' => 'country', 'attribute_group_id' => 17],
            ['id' => 135, 'name' => 'state_or_province', 'attribute_group_id' => 17],
            ['id' => 136, 'name' => 'city', 'attribute_group_id' => 17],
            ['id' => 137, 'name' => 'region', 'attribute_group_id' => 17],
        ]);
    }

    private function technology(): void
    {
        $this->seed([
            ['id' => 140, 'name' => 'computing', 'attribute_group_id' => 18],
            ['id' => 141, 'name' => 'programming', 'attribute_group_id' => 18],
            ['id' => 142, 'name' => 'artificial_intelligence', 'attribute_group_id' => 18],
            ['id' => 143, 'name' => 'electronics', 'attribute_group_id' => 18],
            ['id' => 144, 'name' => 'internet_technology', 'attribute_group_id' => 18],
            ['id' => 145, 'name' => 'space_technology', 'attribute_group_id' => 18],
            ['id' => 146, 'name' => 'vehicles', 'attribute_group_id' => 18],
            ['id' => 147, 'name' => 'weapons', 'attribute_group_id' => 18],
        ]);
    }

    private function fiction(): void
    {
        $this->seed([
            ['id' => 148, 'name' => 'alignment', 'attribute_group_id' => 19],
            ['id' => 149, 'name' => 'role', 'attribute_group_id' => 19],
            ['id' => 150, 'name' => 'occupation', 'attribute_group_id' => 19],
            ['id' => 151, 'name' => 'origin', 'attribute_group_id' => 19],
            ['id' => 152, 'name' => 'universe', 'attribute_group_id' => 19],
            ['id' => 153, 'name' => 'organization', 'attribute_group_id' => 19],
            ['id' => 154, 'name' => 'equipment', 'attribute_group_id' => 19],
            ['id' => 155, 'name' => 'transformation', 'attribute_group_id' => 19],
        ]);
    }

    private function powers(): void
    {
        $this->seed([
            ['id' => 156, 'name' => 'physical_powers', 'attribute_group_id' => 20],
            ['id' => 157, 'name' => 'elemental_powers', 'attribute_group_id' => 20],
            ['id' => 158, 'name' => 'mental_powers', 'attribute_group_id' => 20],
            ['id' => 159, 'name' => 'magical_powers', 'attribute_group_id' => 20],
            ['id' => 160, 'name' => 'space_time_powers', 'attribute_group_id' => 20],
            ['id' => 161, 'name' => 'movement_powers', 'attribute_group_id' => 20],
            ['id' => 162, 'name' => 'defensive_powers', 'attribute_group_id' => 20],
            ['id' => 163, 'name' => 'offensive_powers', 'attribute_group_id' => 20],
            ['id' => 164, 'name' => 'special_abilities', 'attribute_group_id' => 20],
        ]);
    }

    private function miscellaneous(): void
    {
        $this->seed([
            ['id' => 165, 'name' => 'nicknames', 'attribute_group_id' => 24],
            ['id' => 166, 'name' => 'legal', 'attribute_group_id' => 24],
            ['id' => 167, 'name' => 'philanthropy', 'attribute_group_id' => 24],
            ['id' => 168, 'name' => 'controversies', 'attribute_group_id' => 24],
            ['id' => 169, 'name' => 'catchphrases', 'attribute_group_id' => 24],
            ['id' => 171, 'name' => 'rivalries', 'attribute_group_id' => 24],
            ['id' => 172, 'name' => 'signature_traits', 'attribute_group_id' => 24],
        ]);
    }
}
