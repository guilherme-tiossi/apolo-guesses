<?php

namespace App\Core\Application\Player\Services\CreatePlayer;

use App\Models\Player;
use Illuminate\Support\Facades\DB;

class CreatePlayer
{
    public function execute(): OutputDto
    {
        $player = Player::create([
            'possible_characters_count' => DB::select('select count(*) from characters')[0]->count
        ]);

        return new OutputDto(
            userId: $player->id
        );
    }
}