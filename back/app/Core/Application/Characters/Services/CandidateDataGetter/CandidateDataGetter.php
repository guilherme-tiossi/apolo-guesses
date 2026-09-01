<?php

namespace App\Core\Application\Characters\Services\CandidateDataGetter;

use Exception;

class CandidateDataGetter
{
    public function __construct(
        private NaiveBayesCandidateAttributeGetter $naiveBayesGetter
    ) {
    }

    public function execute(InputDto $dto): OutputDto
    {
        $dto = new InputDto(
            playerId: $dto->playerId,
            answers: $dto->answers,
            attributesIn: $dto->attributesIn
        );

        return $this->naiveBayesGetter->execute($dto)
            ?? throw new Exception('Personagem não encontrado', 404);;
    }
}