<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        $characters = [
            // 1 - Futebolista
            ['name' => 'Pelé', 'character_category_id' => 1],
            ['name' => 'Neymar', 'character_category_id' => 1],
            ['name' => 'Ronaldinho Gaúcho', 'character_category_id' => 1],
            ['name' => 'Romário', 'character_category_id' => 1],
            ['name' => 'Cristiano Ronaldo', 'character_category_id' => 1],
            ['name' => 'Lionel Messi', 'character_category_id' => 1],
            ['name' => 'Vini Jr.', 'character_category_id' => 1],
            ['name' => 'Rivaldo', 'character_category_id' => 1],

            // 2 - Jogador de basquete
            ['name' => 'Oscar Schmidt', 'character_category_id' => 2],
            ['name' => 'Michael Jordan', 'character_category_id' => 2],
            ['name' => 'LeBron James', 'character_category_id' => 2],

            // 3 - Lutador de MMA
            ['name' => 'Anderson Silva', 'character_category_id' => 3],
            ['name' => 'José Aldo', 'character_category_id' => 3],
            ['name' => 'Charles do Bronx', 'character_category_id' => 3],
            ['name' => 'Conor McGregor', 'character_category_id' => 3],

            // 4 - Boxeador
            ['name' => 'Mike Tyson', 'character_category_id' => 4],
            ['name' => 'Muhammad Ali', 'character_category_id' => 4],
            ['name' => 'Popó', 'character_category_id' => 4],

            // 5 - Tenista
            ['name' => 'Gustavo Kuerten', 'character_category_id' => 5],
            ['name' => 'Rafael Nadal', 'character_category_id' => 5],

            // 6 - Piloto de Fórmula 1
            ['name' => 'Ayrton Senna', 'character_category_id' => 6],
            ['name' => 'Nelson Piquet', 'character_category_id' => 6],
            ['name' => 'Lewis Hamilton', 'character_category_id' => 6],

            // 7 - Surfista
            ['name' => 'Gabriel Medina', 'character_category_id' => 7],
            ['name' => 'Ítalo Ferreira', 'character_category_id' => 7],

            // 8 - Atleta olímpico
            ['name' => 'Daiane dos Santos', 'character_category_id' => 8],
            ['name' => 'César Cielo', 'character_category_id' => 8],
            ['name' => 'Rebeca Andrade', 'character_category_id' => 8],

            // 9 - Cozinheiro / Chef
            ['name' => 'Erick Jacquin', 'character_category_id' => 9],
            ['name' => 'Paola Carosella', 'character_category_id' => 9],
            ['name' => 'Henrique Fogaça', 'character_category_id' => 9],

            // 10 - Apresentador de TV
            ['name' => 'Silvio Santos', 'character_category_id' => 10],
            ['name' => 'Faustão', 'character_category_id' => 10],
            ['name' => 'Luciano Huck', 'character_category_id' => 10],
            ['name' => 'Ana Maria Braga', 'character_category_id' => 10],
            ['name' => 'Galvão Bueno', 'character_category_id' => 10],
            ['name' => 'Hebe Camargo', 'character_category_id' => 10],

            // 11 - Youtuber
            ['name' => 'Felipe Neto', 'character_category_id' => 11],
            ['name' => 'Whindersson Nunes', 'character_category_id' => 11],
            ['name' => 'Casimiro', 'character_category_id' => 11],

            // 12 - Influenciador
            ['name' => 'Virgínia Fonseca', 'character_category_id' => 12],
            ['name' => 'Bruna Marquezine', 'character_category_id' => 12],

            // 13 - Ator
            ['name' => 'Wagner Moura', 'character_category_id' => 13],
            ['name' => 'Lázaro Ramos', 'character_category_id' => 13],
            ['name' => 'Tony Ramos', 'character_category_id' => 13],
            ['name' => 'Rodrigo Santoro', 'character_category_id' => 13],

            // 14 - Atriz
            ['name' => 'Fernanda Montenegro', 'character_category_id' => 14],
            ['name' => 'Taís Araújo', 'character_category_id' => 14],
            ['name' => 'Camila Pitanga', 'character_category_id' => 14],
            ['name' => 'Regina Casé', 'character_category_id' => 14],

            // 15 - Cantor
            ['name' => 'Roberto Carlos', 'character_category_id' => 15],
            ['name' => 'Caetano Veloso', 'character_category_id' => 15],
            ['name' => 'Gilberto Gil', 'character_category_id' => 15],
            ['name' => 'Zeca Pagodinho', 'character_category_id' => 15],
            ['name' => 'Michael Jackson', 'character_category_id' => 15],

            // 16 - Cantora
            ['name' => 'Anitta', 'character_category_id' => 16],
            ['name' => 'Elis Regina', 'character_category_id' => 16],
            ['name' => 'Marília Mendonça', 'character_category_id' => 16],
            ['name' => 'Ivete Sangalo', 'character_category_id' => 16],

            // 17 - Compositor
            ['name' => 'Tom Jobim', 'character_category_id' => 17],
            ['name' => 'Chico Buarque', 'character_category_id' => 17],

            // 18 - Diretor de cinema
            ['name' => 'Fernando Meirelles', 'character_category_id' => 18],
            ['name' => 'Walter Salles', 'character_category_id' => 18],
            ['name' => 'Steven Spielberg', 'character_category_id' => 18],

            // 19 - Comediante / Humorista
            ['name' => 'Chico Anysio', 'character_category_id' => 19],
            ['name' => 'Renato Aragão', 'character_category_id' => 19],
            ['name' => 'Tirullipa', 'character_category_id' => 19],
            ['name' => 'Fábio Porchat', 'character_category_id' => 19],

            // 20 - Político
            ['name' => 'Getúlio Vargas', 'character_category_id' => 20],
            ['name' => 'Jair Bolsonaro', 'character_category_id' => 20],
            ['name' => 'Luiz Inácio Lula da Silva', 'character_category_id' => 20],
            ['name' => 'Fernando Henrique Cardoso', 'character_category_id' => 20],
            ['name' => 'Tancredo Neves', 'character_category_id' => 20],
            ['name' => 'Dilma Rousseff', 'character_category_id' => 20],

            // 21 - Figura histórica
            ['name' => 'Dom Pedro I', 'character_category_id' => 21],
            ['name' => 'Tiradentes', 'character_category_id' => 21],
            ['name' => 'Zumbi dos Palmares', 'character_category_id' => 21],
            ['name' => 'Princesa Isabel', 'character_category_id' => 21],
            ['name' => 'Napoleão Bonaparte', 'character_category_id' => 21],

            // 22 - Rei / Imperador
            ['name' => 'Dom Pedro II', 'character_category_id' => 22],
            ['name' => 'Rei Charles III', 'character_category_id' => 22],
            ['name' => 'Rainha Elizabeth II', 'character_category_id' => 22],

            // 23 - Filósofo
            ['name' => 'Sócrates', 'character_category_id' => 23],
            ['name' => 'Platão', 'character_category_id' => 23],
            ['name' => 'Friedrich Nietzsche', 'character_category_id' => 23],

            // 24 - Cientista
            ['name' => 'Albert Einstein', 'character_category_id' => 24],
            ['name' => 'Oswaldo Cruz', 'character_category_id' => 24],
            ['name' => 'Marie Curie', 'character_category_id' => 24],

            // 25 - Escritor
            ['name' => 'Machado de Assis', 'character_category_id' => 25],
            ['name' => 'Jorge Amado', 'character_category_id' => 25],
            ['name' => 'Clarice Lispector', 'character_category_id' => 25],
            ['name' => 'Paulo Coelho', 'character_category_id' => 25],

            // 26 - Poeta
            ['name' => 'Carlos Drummond de Andrade', 'character_category_id' => 26],
            ['name' => 'Vinicius de Moraes', 'character_category_id' => 26],
            ['name' => 'Cecília Meireles', 'character_category_id' => 26],

            // 27 - Pintor
            ['name' => 'Tarsila do Amaral', 'character_category_id' => 27],
            ['name' => 'Cândido Portinari', 'character_category_id' => 27],
            ['name' => 'Pablo Picasso', 'character_category_id' => 27],

            // 28 - Escultor
            ['name' => 'Aleijadinho', 'character_category_id' => 28],
            ['name' => 'Victor Brecheret', 'character_category_id' => 28],

            // 29 - Fotógrafo
            ['name' => 'Sebastião Salgado', 'character_category_id' => 29],

            // 30 - Jornalista
            ['name' => 'William Bonner', 'character_category_id' => 30],
            ['name' => 'Fátima Bernardes', 'character_category_id' => 30],

            // 31 - Repórter esportivo
            ['name' => 'Galvão Bueno', 'character_category_id' => 31],
            ['name' => 'Cléber Machado', 'character_category_id' => 31],

            // 32 - Empresário
            ['name' => 'Abilio Diniz', 'character_category_id' => 32],
            ['name' => 'Silvio Santos', 'character_category_id' => 32],
            ['name' => 'Elon Musk', 'character_category_id' => 32],

            // 33 - Investidor
            ['name' => 'Luiz Barsi', 'character_category_id' => 33],
            ['name' => 'Warren Buffett', 'character_category_id' => 33],

            // 34 - CEO de tech
            ['name' => 'Steve Jobs', 'character_category_id' => 34],
            ['name' => 'Mark Zuckerberg', 'character_category_id' => 34],
            ['name' => 'Bill Gates', 'character_category_id' => 34],

            // 35 - Gamer / streamer
            ['name' => 'Casimiro', 'character_category_id' => 35],
            ['name' => 'Gaules', 'character_category_id' => 35],

            // 36 - DJ
            ['name' => 'Alok', 'character_category_id' => 36],
            ['name' => 'Vintage Culture', 'character_category_id' => 36],

            // 37 - Modelo
            ['name' => 'Gisele Bündchen', 'character_category_id' => 37],
            ['name' => 'Adriana Lima', 'character_category_id' => 37],

            // 38 - Designer de moda
            ['name' => 'Oskar Metsavaht', 'character_category_id' => 38],

            // 39 - Militar
            ['name' => 'Duque de Caxias', 'character_category_id' => 39],

            // 40 - Líder religioso
            ['name' => 'Papa Francisco', 'character_category_id' => 40],
            ['name' => 'Padre Marcelo Rossi', 'character_category_id' => 40],
            ['name' => 'Edir Macedo', 'character_category_id' => 40],
            ['name' => 'Silas Malafaia', 'character_category_id' => 40],
            ['name' => 'Dalai Lama', 'character_category_id' => 40],

            // 41 - Astronauta
            ['name' => 'Marcos Pontes', 'character_category_id' => 41],

            // 42 - Médico
            ['name' => 'Drauzio Varella', 'character_category_id' => 42],
            ['name' => 'Oswaldo Cruz', 'character_category_id' => 42],

            // 43 - Advogado
            ['name' => 'Sobral Pinto', 'character_category_id' => 43],

            // 44 - Personagem fictício
            ['name' => 'Zé Pequeno', 'character_category_id' => 44],
            ['name' => 'Capitão Nascimento', 'character_category_id' => 44],
            ['name' => 'Senna (Carandiru)', 'character_category_id' => 44],
            ['name' => 'Seu Madruga', 'character_category_id' => 44],
            ['name' => 'Chaves', 'character_category_id' => 44],

            // 45 - Apresentador de rádio
            ['name' => 'José Luiz Datena', 'character_category_id' => 45],

            // 46 - Mágico / ilusionista
            ['name' => 'David Copperfield', 'character_category_id' => 46],

            // 47 - Dançarino
            ['name' => 'Carlinhos de Jesus', 'character_category_id' => 47],

            // 48 - Chef de confeitaria
            ['name' => 'Mauricio Maia', 'character_category_id' => 48],

            // 49 - Personagem de desenho animado
            ['name' => 'Mônica', 'character_category_id' => 49],
            ['name' => 'Cebolinha', 'character_category_id' => 49],
            ['name' => 'Bob Esponja', 'character_category_id' => 49],
            ['name' => 'Mickey Mouse', 'character_category_id' => 49],
            ['name' => 'Homer Simpson', 'character_category_id' => 49],
        ];

        foreach ($characters as $character) {
            DB::table('characters')->updateOrInsert([
                'name' => $character['name'],
            ], [
                'picture' => '',
                'character_category_id' => $character['character_category_id'],
            ]);
        }
    }
}