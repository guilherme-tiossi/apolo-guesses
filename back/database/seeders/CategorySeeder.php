<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            1  => 'Futebolista',
            2  => 'Jogador de basquete',
            3  => 'Lutador de MMA',
            4  => 'Boxeador',
            5  => 'Tenista',
            6  => 'Piloto de Fórmula 1',
            7  => 'Surfista',
            8  => 'Atleta olímpico',
            9  => 'Cozinheiro / Chef',
            10 => 'Apresentador de TV',
            11 => 'Youtuber',
            12 => 'Influenciador',
            13 => 'Ator',
            14 => 'Atriz',
            15 => 'Cantor',
            16 => 'Cantora',
            17 => 'Compositor',
            18 => 'Diretor de cinema',
            19 => 'Comediante / Humorista',
            20 => 'Político',
            21 => 'Figura histórica',
            22 => 'Rei / Imperador',
            23 => 'Filósofo',
            24 => 'Cientista',
            25 => 'Escritor',
            26 => 'Poeta',
            27 => 'Pintor',
            28 => 'Escultor',
            29 => 'Fotógrafo',
            30 => 'Jornalista',
            31 => 'Repórter esportivo',
            32 => 'Empresário',
            33 => 'Investidor',
            34 => 'CEO de tech',
            35 => 'Gamer / streamer',
            36 => 'DJ',
            37 => 'Modelo',
            38 => 'Designer de moda',
            39 => 'Militar',
            40 => 'Líder religioso',
            41 => 'Astronauta',
            42 => 'Médico',
            43 => 'Advogado',
            44 => 'Personagem fictício',
            45 => 'Apresentador de rádio',
            46 => 'Mágico / ilusionista',
            47 => 'Dançarino',
            48 => 'Chef de confeitaria',
            49 => 'Personagem de desenho animado',
        ];

        foreach ($categories as $id => $name) {
            DB::table('categories')->updateOrInsert([
                'id' => $id,
            ], [
                'name' => $name,
            ]);
        }
    }
}