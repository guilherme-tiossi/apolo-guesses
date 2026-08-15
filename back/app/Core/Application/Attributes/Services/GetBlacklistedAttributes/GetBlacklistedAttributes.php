<?php

namespace App\Core\Application\Attributes\Services\GetBlacklistedAttributes;

use App\Core\Domain\Attributes\Entities\Attribute;
use App\Core\Domain\Attributes\Enums\InitialAttribute;
use App\Core\Domain\Attributes\Enums\SecondaryAttribute;
use App\Models\PlayerAttributeBlacklist;

class GetBlacklistedAttributes
{    
    public function execute(InputDto $input): OutputDto
    {
        $baseAttributeBlacklist = PlayerAttributeBlacklist::with('attribute')
            ->where('player_id', $input->playerId)
            ->get()
            ->toArray();

        return new OutputDto(
            attributes: array_map(function ($blacklistItem) {
                $attribute = $blacklistItem['attribute'];
                return new Attribute(
                    id: $attribute['id'],
                    question: $attribute['question'],
                    portugueseQuestion: $attribute['portuguese_question'],
                    enum: $attribute['is_initial_question']
                        ? InitialAttribute::tryFrom($attribute['internal_name'])
                        : ($attribute['is_secondary_question']
                            ? SecondaryAttribute::tryFrom($attribute['internal_name'])
                            : null)

                );
            }, $baseAttributeBlacklist)
        );
    }
}