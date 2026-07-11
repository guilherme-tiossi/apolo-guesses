<?php

namespace App\Core\Application\Attributes\Services\GetQuestion;

readonly class OutputDto {
    public function __construct(
        // mudar para alguma entidade tb ou VO
        public string $question,
        public int $attributeId,
        public int $temporaryUserId
    ) {
    }
}