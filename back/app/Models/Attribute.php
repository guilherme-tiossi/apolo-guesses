<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['internal_name', 'character_id'])]
class Attribute extends Model
{
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
