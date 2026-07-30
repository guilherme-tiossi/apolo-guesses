<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['player_id', 'attribute_id', 'answer_score'])]
class PlayerAnswer extends Model
{
    public $timestamps = false;

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}
