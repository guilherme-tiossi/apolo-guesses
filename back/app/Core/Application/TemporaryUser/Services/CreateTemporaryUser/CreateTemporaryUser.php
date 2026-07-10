<?php

namespace App\Core\Application\TemporaryUser\Services\CreateTemporaryUser;

use App\Models\TemporaryUser;
use Illuminate\Support\Facades\DB;

class CreateTemporaryUser
{
    public function execute(): OutputDto
    {
        $temporaryUser = TemporaryUser::create([
            'possible_characters_count' => DB::select('select count(*) from characters')[0]->count
        ]);

        return new OutputDto(
            userId: $temporaryUser->id
        );
    }
}