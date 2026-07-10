<?php

namespace App\Core\Application\Attributes\UseCases\GetInitialQuestion;

readonly class OutputDto {
    public function __construct(
        // mudar para alguma entidade tb ou VO
        public string $question,
        public int $attributeId,
        public int $temporaryUserId
    ) {
    }
}