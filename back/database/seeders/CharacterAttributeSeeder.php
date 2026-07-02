<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CharacterAttributeSeeder extends Seeder
{
    public function run(): void
    {
        $this->pele();
        $this->muhammadAli();
        $this->ayrtonSenna();
        $this->rebecaAndrade();
        $this->anaMariaBraga();
    }

    private function seedCharacter(string $characterName, array $attributes): void
    {
        $characterId = $this->characterId($characterName);

        foreach ($attributes as $question => $score) {
            DB::table('character_attributes')->updateOrInsert(
                [
                    'character_id' => $characterId,
                    'attribute_id' => $this->attributeId($question),
                ],
                [
                    'score' => $score,
                ]
            );
        }
    }

    private function characterId(string $name): int
    {
        $id = DB::table('characters')->where('name', $name)->value('id');

        if ($id === null) {
            throw new RuntimeException("Character not found: {$name}");
        }

        return $id;
    }

    private function attributeId(string $question): int
    {
        $id = DB::table('attributes')->where('question', $question)->value('id');

        if ($id === null) {
            throw new RuntimeException("Attribute not found: {$question}");
        }

        return $id;
    }

    private function pele(): void
    {
        $this->seedCharacter('Pelé', [
            'Does your character have dark skin?' => 2,
            'Is your character Brazilian?' => 2,
            'Is your character male?' => 2,
            'Is your character deceased?' => 2,
            'Is your character described as Black?' => 2,
            'Does your character have a athletic build?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character play football professionally?' => 2,
            'Does your character score many goals?' => 2,
            'Does your character play in international tournaments?' => 2,
            'Does your character be known for dribbling?' => 2,
            'Does your character have football as main identity?' => 2,
            'Is your character mainly a player?' => 2,
            'Was your character born in Brazil?' => 2,
            'Has your character won major international awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
        ]);
    }

    private function muhammadAli(): void
    {
        $this->seedCharacter('Muhammad Ali', [
            'Does your character have dark skin?' => 2,
            'Is your character American?' => 2,
            'Is your character male?' => 2,
            'Is your character deceased?' => 2,
            'Is your character described as Black?' => 2,
            'Does your character have a muscular build?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Does your character compete in boxing?' => 2,
            'Does your character compete in high-level combat tournaments?' => 2,
            'Is your character mainly a player?' => 2,
            'Has your character won major international awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Does your character have an iconic catchphrase?' => 2,
            'Is your character associated with political controversy?' => 1.5,
            'Does your character inspire others?' => 2,
        ]);
    }

    private function ayrtonSenna(): void
    {
        $this->seedCharacter('Ayrton Senna', [
            'Is your character Brazilian?' => 2,
            'Is your character male?' => 2,
            'Is your character deceased?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Is your character associated with motorsports?' => 2,
            'Was your character born in Brazil?' => 2,
            'Is your character impulsive?' => 1.5,
            'Does your character take command in crisis?' => 2,
            'Does your character inspire others?' => 2,
            'Does your character hold a speed record?' => 2,
            'Does your character hold multiple records?' => 2,
            'Is your character known by world champion title?' => 2,
            'Is your character known by legend title?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received a historic level of recognition?' => 2,
            'Is your character mainly a player?' => 2,
        ]);
    }

    private function rebecaAndrade(): void
    {
        $this->seedCharacter('Rebeca Andrade', [
            'Is your character Brazilian?' => 2,
            'Is your character female?' => 2,
            'Is your character alive?' => 2,
            'Is your character described as Black?' => 2,
            'Does your character have a athletic build?' => 2,
            'Is your character in their twenties?' => 1,
            'Is your character in their thirties?' => 2,
            'Is your character a athlete?' => 2,
            'Does your character work in sports?' => 2,
            'Is your character associated with olympic events?' => 2,
            'Is your character mainly a player?' => 2,
            'Was your character born in Brazil?' => 2,
            'Has your character won major international awards?' => 2,
            'Has your character won national awards?' => 2,
            'Is your character known by world champion title?' => 2,
            'Has your character received international recognition?' => 2,
            'Has your character received media recognition?' => 2,
        ]);
    }

    private function anaMariaBraga(): void
    {
        $this->seedCharacter('Ana Maria Braga', [
            'Is your character Brazilian?' => 2,
            'Is your character female?' => 2,
            'Is your character alive?' => 2,
            'Is your character elderly?' => 2,
            'Does your character have brown skin?' => 1,
            'Does your character work in entertainment?' => 2,
            'Does your character work in television?' => 2,
            'Is your character known in talk shows?' => 2,
            'Is your character known in prime-time shows?' => 1.5,
            'Was your character born in Brazil?' => 2,
            'Is your character warm and friendly?' => 2,
            'Does your character make jokes often?' => 1.5,
            'Does your character like cooking at home?' => 2,
            'Has your character won national awards?' => 1.5,
            'Has your character received media recognition?' => 2,
            'Has your character received public recognition?' => 2,
        ]);
    }
}
