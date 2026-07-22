<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'picture', 'character_category_id'])]
class Character extends Model
{
    public function characterCategory(): BelongsTo
    {
        return $this->belongsTo(CharacterCategory::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(CharacterAttribute::class);
    }
}
