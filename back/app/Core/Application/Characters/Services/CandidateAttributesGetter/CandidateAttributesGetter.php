<?php

namespace App\Core\Application\Characters\Services\CandidateAttributesGetter;

use App\Core\Application\Answers\UseCases\GetAnswers\GetAnswers;
use App\Core\Application\Answers\UseCases\GetAnswers\InputDto as GetAnswersDto;
use Exception;
use Illuminate\Support\Facades\DB;

class CandidateAttributesGetter
{
    public function __construct(
        private GetAnswers $getAnswers
    ) {
    }

    // MUDAR NOMENCLATURAS E DTOS DESSE CARA!
    // pega apenas perguntas não respondidas
    public function execute(InputDto $dto): OutputDto
    {
        $answers = $this->getAnswers->execute(new GetAnswersDto(
            userId: $dto->temporaryUserId
        ))->answers;

        $candidatesAttributes = $this->getCandidatesData($answers);

        if (!empty($candidatesAttributes)) {
            return new OutputDto(
                candidatesAttributes: $candidatesAttributes
            );
        }

        $candidatesAttributes = $this->getCandidatesData($answers, true);

        if (!empty($candidatesAttributes)) {
            return new OutputDto(
                candidatesAttributes: $candidatesAttributes
            );
        }

        throw new Exception('Personagem não encontrado', 404);
    }

    private function getCandidatesData(array $answers, bool $getBroadResults = false): array
    {
        $filters = [];
        $answeredAttributeIds = [];
        foreach ($answers as $answer) {
            if ($answer->value < 1.25) {
                continue;
            }
            $attributeScore = $getBroadResults ? 1.25 : $answer->value;

            $filters[] = [
                'id' => $answer->attribute->id,
                'score' => $attributeScore
            ];

            $answeredAttributeIds[] = $answer->attribute->id;
        }

        $subQueryCharacters = DB::table('character_attributes')
            ->select('character_id')
            ->where(function($query) use ($filters) {
                foreach ($filters as $filter) {
                    $query->orWhere(function($sub) use ($filter) {
                        $sub->where('attribute_id', $filter['id'])
                            ->where('score', '>=', $filter['score']);
                    });
                }
            })
            ->groupBy('character_id')
            ->havingRaw('COUNT(DISTINCT attribute_id) = ?', [count($filters)]);

        $characterAttributeData = DB::table('characters')
            ->join('character_attributes', 'character_attributes.character_id', '=', 'characters.id')
            ->whereNotIn('attribute_id', $answeredAttributeIds)
            ->whereIn('characters.id', $subQueryCharacters)
            ->get([
                'characters.id as character_id',
                'character_attributes.attribute_id as attribute_id'
            ])->toArray();

        return $characterAttributeData;
    }
}