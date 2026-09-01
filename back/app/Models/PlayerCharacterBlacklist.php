<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['player_id', 'character_id'])]
class PlayerCharacterBlacklist extends Model
{
    public $timestamps = false;

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
