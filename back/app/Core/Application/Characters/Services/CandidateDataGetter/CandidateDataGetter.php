<?php

namespace App\Core\Application\Characters\Services\CandidateDataGetter;

use Exception;

class CandidateDataGetter
{
    public function __construct(
        private FilterCandidateAttributeGetter $filterGetter,
        private NaiveBayesCandidateAttributeGetter $naiveBayesGetter
    ) {
    }

    public function execute(InputDto $dto): OutputDto
    {
        $dto = new InputDto(
            playerId: $dto->playerId,
            answers: $dto->answers
        );

        return $this->filterGetter->execute($dto)
            ?? $this->naiveBayesGetter->execute($dto)
            ?? throw new Exception('Personagem não encontrado', 404);;
    }
}