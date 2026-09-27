<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['id', 'exception'])]
class ErrorLog extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';
}
