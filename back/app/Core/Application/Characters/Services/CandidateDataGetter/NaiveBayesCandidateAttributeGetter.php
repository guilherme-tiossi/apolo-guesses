<?php

namespace App\Core\Application\Characters\Services\CandidateDataGetter;

use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Models\CharacterAttribute;
use Illuminate\Support\Facades\DB;

class NaiveBayesCandidateAttributeGetter
{
    public function __construct(
    ) {
    }

    public function execute(InputDto $dto): ?OutputDto
    {
        $candidates = $this->getCandidates($dto->answers, $dto->attributesIn);

        $highestBayes = $candidates[0]['bayes_value'] ?? null;
        if (!$highestBayes) {
            return null;
        }

        $minimumBayes = $highestBayes * 0.50;
        foreach ($candidates as $index => $candidate) {
            if ($candidate['bayes_value'] < $minimumBayes) {
                unset($candidates[$index]);
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

    private function getCandidates(array $answers, ?array $attributesIn = null): array
    {
        
        $positiveAnswersByAttributeId = [];
        $negativeAnswersByAttributeId = [];
        foreach ($answers as $key => $answer) {
            if ($answer->value == 1) {
                continue;
            }

            $answer->value > 1
                ? $positiveAnswersByAttributeId[$answer->attribute->id] = $answer
                : $negativeAnswersByAttributeId[$answer->attribute->id] = $answer;
        }

        $baseCandidates = CharacterAttribute::charactersByAnswers(answers: $answers, attributesIn: $attributesIn)->get()->toArray() ?: 
            CharacterAttribute::charactersByAnswers(answers: $answers, excludingNegativeAnswers: true, attributesIn: $attributesIn)->get()->toArray();

        // se não acha talvez pegar só com atributos iniciais

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