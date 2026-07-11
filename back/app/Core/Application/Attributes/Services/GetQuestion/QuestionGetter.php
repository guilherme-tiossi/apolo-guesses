<?php

namespace App\Core\Application\Attributes\Services\GetQuestion;

interface QuestionGetter {
    public function execute(InputDto $dto): OutputDto;
}