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
            ['name' => 'Pelé', 'category_id' => 1],
            ['name' => 'Neymar', 'category_id' => 1],
            ['name' => 'Ronaldinho Gaúcho', 'category_id' => 1],
            ['name' => 'Romário', 'category_id' => 1],
            ['name' => 'Cristiano Ronaldo', 'category_id' => 1],
            ['name' => 'Lionel Messi', 'category_id' => 1],
            ['name' => 'Vini Jr.', 'category_id' => 1],
            ['name' => 'Rivaldo', 'category_id' => 1],

            // 2 - Jogador de basquete
            ['name' => 'Oscar Schmidt', 'category_id' => 2],
            ['name' => 'Michael Jordan', 'category_id' => 2],
            ['name' => 'LeBron James', 'category_id' => 2],

            // 3 - Lutador de MMA
            ['name' => 'Anderson Silva', 'category_id' => 3],
            ['name' => 'José Aldo', 'category_id' => 3],
            ['name' => 'Charles do Bronx', 'category_id' => 3],
            ['name' => 'Conor McGregor', 'category_id' => 3],

            // 4 - Boxeador
            ['name' => 'Mike Tyson', 'category_id' => 4],
            ['name' => 'Muhammad Ali', 'category_id' => 4],
            ['name' => 'Popó', 'category_id' => 4],

            // 5 - Tenista
            ['name' => 'Gustavo Kuerten', 'category_id' => 5],
            ['name' => 'Rafael Nadal', 'category_id' => 5],

            // 6 - Piloto de Fórmula 1
            ['name' => 'Ayrton Senna', 'category_id' => 6],
            ['name' => 'Nelson Piquet', 'category_id' => 6],
            ['name' => 'Lewis Hamilton', 'category_id' => 6],

            // 7 - Surfista
            ['name' => 'Gabriel Medina', 'category_id' => 7],
            ['name' => 'Ítalo Ferreira', 'category_id' => 7],

            // 8 - Atleta olímpico
            ['name' => 'Daiane dos Santos', 'category_id' => 8],
            ['name' => 'César Cielo', 'category_id' => 8],
            ['name' => 'Rebeca Andrade', 'category_id' => 8],

            // 9 - Cozinheiro / Chef
            ['name' => 'Erick Jacquin', 'category_id' => 9],
            ['name' => 'Paola Carosella', 'category_id' => 9],
            ['name' => 'Henrique Fogaça', 'category_id' => 9],

            // 10 - Apresentador de TV
            ['name' => 'Silvio Santos', 'category_id' => 10],
            ['name' => 'Faustão', 'category_id' => 10],
            ['name' => 'Luciano Huck', 'category_id' => 10],
            ['name' => 'Ana Maria Braga', 'category_id' => 10],
            ['name' => 'Galvão Bueno', 'category_id' => 10],
            ['name' => 'Hebe Camargo', 'category_id' => 10],

            // 11 - Youtuber
            ['name' => 'Felipe Neto', 'category_id' => 11],
            ['name' => 'Whindersson Nunes', 'category_id' => 11],
            ['name' => 'Casimiro', 'category_id' => 11],

            // 12 - Influenciador
            ['name' => 'Virgínia Fonseca', 'category_id' => 12],
            ['name' => 'Bruna Marquezine', 'category_id' => 12],

            // 13 - Ator
            ['name' => 'Wagner Moura', 'category_id' => 13],
            ['name' => 'Lázaro Ramos', 'category_id' => 13],
            ['name' => 'Tony Ramos', 'category_id' => 13],
            ['name' => 'Rodrigo Santoro', 'category_id' => 13],

            // 14 - Atriz
            ['name' => 'Fernanda Montenegro', 'category_id' => 14],
            ['name' => 'Taís Araújo', 'category_id' => 14],
            ['name' => 'Camila Pitanga', 'category_id' => 14],
            ['name' => 'Regina Casé', 'category_id' => 14],

            // 15 - Cantor
            ['name' => 'Roberto Carlos', 'category_id' => 15],
            ['name' => 'Caetano Veloso', 'category_id' => 15],
            ['name' => 'Gilberto Gil', 'category_id' => 15],
            ['name' => 'Zeca Pagodinho', 'category_id' => 15],
            ['name' => 'Michael Jackson', 'category_id' => 15],

            // 16 - Cantora
            ['name' => 'Anitta', 'category_id' => 16],
            ['name' => 'Elis Regina', 'category_id' => 16],
            ['name' => 'Marília Mendonça', 'category_id' => 16],
            ['name' => 'Ivete Sangalo', 'category_id' => 16],

            // 17 - Compositor
            ['name' => 'Tom Jobim', 'category_id' => 17],
            ['name' => 'Chico Buarque', 'category_id' => 17],

            // 18 - Diretor de cinema
            ['name' => 'Fernando Meirelles', 'category_id' => 18],
            ['name' => 'Walter Salles', 'category_id' => 18],
            ['name' => 'Steven Spielberg', 'category_id' => 18],

            // 19 - Comediante / Humorista
            ['name' => 'Chico Anysio', 'category_id' => 19],
            ['name' => 'Renato Aragão', 'category_id' => 19],
            ['name' => 'Tirullipa', 'category_id' => 19],
            ['name' => 'Fábio Porchat', 'category_id' => 19],

            // 20 - Político
            ['name' => 'Getúlio Vargas', 'category_id' => 20],
            ['name' => 'Jair Bolsonaro', 'category_id' => 20],
            ['name' => 'Luiz Inácio Lula da Silva', 'category_id' => 20],
            ['name' => 'Fernando Henrique Cardoso', 'category_id' => 20],
            ['name' => 'Tancredo Neves', 'category_id' => 20],
            ['name' => 'Dilma Rousseff', 'category_id' => 20],

            // 21 - Figura histórica
            ['name' => 'Dom Pedro I', 'category_id' => 21],
            ['name' => 'Tiradentes', 'category_id' => 21],
            ['name' => 'Zumbi dos Palmares', 'category_id' => 21],
            ['name' => 'Princesa Isabel', 'category_id' => 21],
            ['name' => 'Napoleão Bonaparte', 'category_id' => 21],

            // 22 - Rei / Imperador
            ['name' => 'Dom Pedro II', 'category_id' => 22],
            ['name' => 'Rei Charles III', 'category_id' => 22],
            ['name' => 'Rainha Elizabeth II', 'category_id' => 22],

            // 23 - Filósofo
            ['name' => 'Sócrates', 'category_id' => 23],
            ['name' => 'Platão', 'category_id' => 23],
            ['name' => 'Friedrich Nietzsche', 'category_id' => 23],

            // 24 - Cientista
            ['name' => 'Albert Einstein', 'category_id' => 24],
            ['name' => 'Oswaldo Cruz', 'category_id' => 24],
            ['name' => 'Marie Curie', 'category_id' => 24],

            // 25 - Escritor
            ['name' => 'Machado de Assis', 'category_id' => 25],
            ['name' => 'Jorge Amado', 'category_id' => 25],
            ['name' => 'Clarice Lispector', 'category_id' => 25],
            ['name' => 'Paulo Coelho', 'category_id' => 25],

            // 26 - Poeta
            ['name' => 'Carlos Drummond de Andrade', 'category_id' => 26],
            ['name' => 'Vinicius de Moraes', 'category_id' => 26],
            ['name' => 'Cecília Meireles', 'category_id' => 26],

            // 27 - Pintor
            ['name' => 'Tarsila do Amaral', 'category_id' => 27],
            ['name' => 'Cândido Portinari', 'category_id' => 27],
            ['name' => 'Pablo Picasso', 'category_id' => 27],

            // 28 - Escultor
            ['name' => 'Aleijadinho', 'category_id' => 28],
            ['name' => 'Victor Brecheret', 'category_id' => 28],

            // 29 - Fotógrafo
            ['name' => 'Sebastião Salgado', 'category_id' => 29],

            // 30 - Jornalista
            ['name' => 'William Bonner', 'category_id' => 30],
            ['name' => 'Fátima Bernardes', 'category_id' => 30],

            // 31 - Repórter esportivo
            ['name' => 'Galvão Bueno', 'category_id' => 31],
            ['name' => 'Cléber Machado', 'category_id' => 31],

            // 32 - Empresário
            ['name' => 'Abilio Diniz', 'category_id' => 32],
            ['name' => 'Silvio Santos', 'category_id' => 32],
            ['name' => 'Elon Musk', 'category_id' => 32],

            // 33 - Investidor
            ['name' => 'Luiz Barsi', 'category_id' => 33],
            ['name' => 'Warren Buffett', 'category_id' => 33],

            // 34 - CEO de tech
            ['name' => 'Steve Jobs', 'category_id' => 34],
            ['name' => 'Mark Zuckerberg', 'category_id' => 34],
            ['name' => 'Bill Gates', 'category_id' => 34],

            // 35 - Gamer / streamer
            ['name' => 'Casimiro', 'category_id' => 35],
            ['name' => 'Gaules', 'category_id' => 35],

            // 36 - DJ
            ['name' => 'Alok', 'category_id' => 36],
            ['name' => 'Vintage Culture', 'category_id' => 36],

            // 37 - Modelo
            ['name' => 'Gisele Bündchen', 'category_id' => 37],
            ['name' => 'Adriana Lima', 'category_id' => 37],

            // 38 - Designer de moda
            ['name' => 'Oskar Metsavaht', 'category_id' => 38],

            // 39 - Militar
            ['name' => 'Duque de Caxias', 'category_id' => 39],

            // 40 - Líder religioso
            ['name' => 'Papa Francisco', 'category_id' => 40],
            ['name' => 'Padre Marcelo Rossi', 'category_id' => 40],
            ['name' => 'Edir Macedo', 'category_id' => 40],
            ['name' => 'Silas Malafaia', 'category_id' => 40],
            ['name' => 'Dalai Lama', 'category_id' => 40],

            // 41 - Astronauta
            ['name' => 'Marcos Pontes', 'category_id' => 41],

            // 42 - Médico
            ['name' => 'Drauzio Varella', 'category_id' => 42],
            ['name' => 'Oswaldo Cruz', 'category_id' => 42],

            // 43 - Advogado
            ['name' => 'Sobral Pinto', 'category_id' => 43],

            // 44 - Personagem fictício
            ['name' => 'Zé Pequeno', 'category_id' => 44],
            ['name' => 'Capitão Nascimento', 'category_id' => 44],
            ['name' => 'Senna (Carandiru)', 'category_id' => 44],
            ['name' => 'Seu Madruga', 'category_id' => 44],
            ['name' => 'Chaves', 'category_id' => 44],

            // 45 - Apresentador de rádio
            ['name' => 'José Luiz Datena', 'category_id' => 45],

            // 46 - Mágico / ilusionista
            ['name' => 'David Copperfield', 'category_id' => 46],

            // 47 - Dançarino
            ['name' => 'Carlinhos de Jesus', 'category_id' => 47],

            // 48 - Chef de confeitaria
            ['name' => 'Mauricio Maia', 'category_id' => 48],

            // 49 - Personagem de desenho animado
            ['name' => 'Mônica', 'category_id' => 49],
            ['name' => 'Cebolinha', 'category_id' => 49],
            ['name' => 'Bob Esponja', 'category_id' => 49],
            ['name' => 'Mickey Mouse', 'category_id' => 49],
            ['name' => 'Homer Simpson', 'category_id' => 49],
        ];

        foreach ($characters as $character) {
            DB::table('characters')->updateOrInsert([
                'name' => $character['name'],
            ], [
                'picture' => '',
                'category_id' => $character['category_id'],
            ]);
        }
    }
}