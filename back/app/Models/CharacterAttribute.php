<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class CharacterAttribute extends Model
{
    /** @var Answer[] */
    // passar isso pra um service talvez
    public static function charactersByAnswers(
        array $answers,
        ?bool $excludingNegativeAnswers = false
    ): Builder {
        $positiveAttributes = [];
        $negativeAttributes = [];
        foreach ($answers as $answer) {
            if ($answer->value >= 1.25) {
                $positiveAttributes[] = $answer->attribute->id;
            }
            if ($answer->value <= 0.25) {
                $negativeAttributes[] = $answer->attribute->id;
            }
        }

        $query = DB::table('character_attributes')
            ->select('character_id')
            ->where(function($query) use ($positiveAttributes) {
                foreach ($positiveAttributes as $positiveAttributeId) {
                    $query->orWhere(function($sub) use ($positiveAttributeId) {
                        $sub->where('attribute_id', $positiveAttributeId)
                            ->where('score', '>=', 1.25);
                    });
                }
            });
        
        if (!$excludingNegativeAnswers) {
            $query->whereNotIn('character_id', function ($query2) use ($negativeAttributes) {
                foreach ($negativeAttributes as $negativeAttributeId) {
                    $query2->select('character_id')
                        ->from('character_attributes')
                        ->orWhere('attribute_id', $negativeAttributeId);
                }
            });
        }

        return $query->groupBy('character_id')
            ->havingRaw('COUNT(DISTINCT attribute_id) = ?', [count($positiveAttributes)]);
    }
}
