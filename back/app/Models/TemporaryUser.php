<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['possible_characters_count'])]
class TemporaryUser extends Model
{
    public $timestamps = false;
}
