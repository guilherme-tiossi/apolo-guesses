<?php

namespace App\Core\Application\Characters\Services\CandidateDataGetter;

use App\Models\CharacterAttribute;
use Illuminate\Support\Facades\DB;

class FilterCandidateAttributeGetter
{
    public function __construct(
    ) {
    }

    public function execute(InputDto $dto): ?OutputDto
    {
        $candidatesAttributes = $this->getCandidatesData($dto->answers);

        if (!empty($candidatesAttributes['characterAttributeData'])) {
            return new OutputDto(
                candidatesAttributes: array_map(function($arrayCharacterAttribute) {
                    return new CandidateAttributeDto(
                        characterId: $arrayCharacterAttribute->character_id,
                        attributeId: $arrayCharacterAttribute->attribute_id
                    );
                }, $candidatesAttributes['characterAttributeData']),
                candidatesCount: $candidatesAttributes['candidates']
            );
        }

        return null;
    }

    private function getCandidatesData(array $answers): array
    {
        $answeredAttributeIds = [];
        foreach ($answers as $answer) {
            $answeredAttributeIds[] = $answer->attribute->id;
        }

        $subQueryCharacters = CharacterAttribute::charactersByAnswers($answers);

        $characterAttributeData = DB::table('characters')
            ->join('character_attributes', 'character_attributes.character_id', '=', 'characters.id')
            ->whereNotIn('attribute_id', $answeredAttributeIds)
            ->whereIn('characters.id', $subQueryCharacters)
            ->get([
                'characters.id as character_id',
                'character_attributes.attribute_id'
            ])->toArray();

        return [
            'characterAttributeData' => $characterAttributeData,
            'candidates' => $subQueryCharacters->count()
        ];
    }
}