<?php

namespace App\Core\Application\Characters\Services\CandidateDataGetter;

use App\Models\CharacterAttribute;
use App\Models\PlayerCharacterBlacklist;
use Illuminate\Support\Facades\DB;

class NaiveBayesCandidateAttributeGetter
{
    public function __construct(
    ) {
    }

    public function execute(InputDto $dto): ?OutputDto
    {
        $candidates = $this->getCandidates($dto->playerId, $dto->answers, $dto->attributesIn);

        $highestBayes = $candidates[0]['bayes_value'] ?? null;
        if (!$highestBayes) {
            return null;
        }

        $minimumBayes = $highestBayes * 0.75;
        foreach ($candidates as $index => $candidate) {
            if ($candidate['bayes_value'] < $minimumBayes) {
                unset($candidates[$index]);
                PlayerCharacterBlacklist::create([
                    'player_id' => $dto->playerId,
                    'character_id' => $candidate['character_id']
                ]);
            }
        }

        $candidateAttributes = [];
        foreach ($candidates as $candidate) {
            $attributes = count($candidates) > 1 ?
                DB::table('character_attributes')
                    ->join('attributes', 'attributes.id', '=', 'character_attributes.attribute_id')
                    ->where('character_attributes.character_id', $candidate['character_id'])
                    ->where('attributes.character_id', null)
                    ->get(['character_attributes.attribute_id', 'character_attributes.character_id']) :
                CharacterAttribute::where('character_id', $candidate['character_id'])->get();

            foreach ($attributes as $attribute) {
                $candidateAttributes[] = new CandidateAttributeDto(
                    characterId: $attribute->character_id,
                    attributeId: $attribute->attribute_id
                );
            }
        }

        return new OutputDto(
            candidatesAttributes: $candidateAttributes,
            candidatesCount: count($candidates)
        );
    }

    private function getCandidates(int $playerId, array $answers, ?array $attributesIn = null): array
    {
        $positiveAnswersByAttributeId = [];
        $negativeAnswersByAttributeId = [];
        $initialAnswers = [];
        foreach ($answers as $key => $answer) {
            if ($answer->value == 1) {
                continue;
            }

            if (!empty($answer->attribute->enum) && $answer->value != 1) {
                $initialAnswers[] = $answer;
                continue;
            }

            $answer->value > 1
                ? $positiveAnswersByAttributeId[$answer->attribute->id] = $answer
                : $negativeAnswersByAttributeId[$answer->attribute->id] = $answer;    
        }

        $baseCandidates = CharacterAttribute::charactersByAnswers(playerId: $playerId, answers: $answers, attributesIn: $attributesIn)->get()->toArray() ?: 
            CharacterAttribute::charactersByAnswers(playerId: $playerId, answers: $answers, excludingNegativeAnswers: true, attributesIn: $attributesIn)->get()->toArray() ?:
            CharacterAttribute::charactersByAnswers(playerId: $playerId, answers: $initialAnswers, excludingNegativeAnswers: false, attributesIn: $attributesIn)->get()->toArray();

        unset($answers);

        // variável utilizada como valor mínimo para evitar multiplicações por 0
        // quando candidato não tiver aquele atributo
        $alpha = 1;
        $candidates = [];
        foreach ($baseCandidates as $candidate) {
            $characterAttributes = CharacterAttribute::where('character_id', $candidate->character_id)
                ->whereIn(
                    'attribute_id',
                    array_merge(
                        array_keys($negativeAnswersByAttributeId),
                        array_keys($positiveAnswersByAttributeId)
                    )
                )->get();
            
            $naiveBayes = $alpha;
            // adicionar popularidade nessa conta!!-----------
            foreach ($characterAttributes as $attribute) {
                if (in_array($attribute['attribute_id'], array_keys($negativeAnswersByAttributeId))) {
                    $naiveBayes *= max($alpha, $attribute['score'] * -1);
                } else {
                    $naiveBayes *= $attribute['score'];
                }
            }

            $candidates[] = [
                'character_id' => $candidate->character_id,
                'bayes_value' => $naiveBayes
            ];
        }

        usort($candidates, function ($a, $b) {
            return $b['bayes_value'] <=> $a['bayes_value'];
        });

        return $candidates;
    }
}