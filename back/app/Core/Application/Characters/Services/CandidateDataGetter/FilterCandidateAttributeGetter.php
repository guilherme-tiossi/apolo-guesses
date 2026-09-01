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
        $candidatesAttributes = $this->getCandidatesData($dto->playerId, $dto->answers, $dto->attributesIn);

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

    private function getCandidatesData(int $playerId, array $answers, ?array $attributesIn = null): array
    {
        $answeredAttributeIds = [];
        foreach ($answers as $answer) {
            $answeredAttributeIds[] = $answer->attribute->id;
        }

        $subQueryCharacters = CharacterAttribute::charactersByAnswers(playerId: $playerId, answers: $answers, attributesIn: $attributesIn);
        $qtyCandidates = $subQueryCharacters->count();

        $characterAttributeQuery = DB::table('characters')
            ->join('character_attributes', 'character_attributes.character_id', '=', 'characters.id')
            ->join('attributes', 'attributes.id', '=', 'character_attributes.attribute_id')
            ->whereNotIn('attribute_id', $answeredAttributeIds)
            ->whereIn('characters.id', $subQueryCharacters);
        
        if ($qtyCandidates > 1) {
            $characterAttributeQuery->where('attributes.character_id', null);
        }

        $characterAttributeData = $characterAttributeQuery->get([
                'characters.id as character_id',
                'character_attributes.attribute_id'
            ])->toArray();

        return [
            'characterAttributeData' => $characterAttributeData,
            'candidates' => $subQueryCharacters->count()
        ];
    }
}