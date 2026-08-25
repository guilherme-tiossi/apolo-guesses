<?php

namespace Database\Seeders;

use App\Core\Domain\Shared\Enums\CharacterCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        $characters = [
            // Esporte
            ['name' => 'Pelé', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Neymar', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Ronaldinho Gaúcho', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Romário', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Cristiano Ronaldo', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Lionel Messi', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Vini Jr.', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Rivaldo', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Oscar Schmidt', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Michael Jordan', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'LeBron James', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Anderson Silva', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'José Aldo', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Charles do Bronx', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Conor McGregor', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Mike Tyson', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Muhammad Ali', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Popó', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Gustavo Kuerten', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Rafael Nadal', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Ayrton Senna', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Nelson Piquet', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Lewis Hamilton', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Gabriel Medina', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Ítalo Ferreira', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Daiane dos Santos', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'César Cielo', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Rebeca Andrade', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Galvão Bueno', 'category_id' => CharacterCategory::SPORT],
            ['name' => 'Cléber Machado', 'category_id' => CharacterCategory::SPORT],

            // Mídias sociais
            ['name' => 'Felipe Neto', 'category_id' => CharacterCategory::SOCIAL_MEDIA],
            ['name' => 'Whindersson Nunes', 'category_id' => CharacterCategory::SOCIAL_MEDIA],
            ['name' => 'Casimiro', 'category_id' => CharacterCategory::SOCIAL_MEDIA],
            ['name' => 'Virgínia Fonseca', 'category_id' => CharacterCategory::SOCIAL_MEDIA],
            ['name' => 'Bruna Marquezine', 'category_id' => CharacterCategory::SOCIAL_MEDIA],
            ['name' => 'Gaules', 'category_id' => CharacterCategory::SOCIAL_MEDIA],

            // Política e exército
            ['name' => 'Getúlio Vargas', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Jair Bolsonaro', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Luiz Inácio Lula da Silva', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Fernando Henrique Cardoso', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Tancredo Neves', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Dilma Rousseff', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Dom Pedro I', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Tiradentes', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Zumbi dos Palmares', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Princesa Isabel', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Napoleão Bonaparte', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Dom Pedro II', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Rei Charles III', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Rainha Elizabeth II', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Duque de Caxias', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],
            ['name' => 'Sobral Pinto', 'category_id' => CharacterCategory::POLITICS_AND_MILITARY],

            // Religião
            ['name' => 'Papa Francisco', 'category_id' => CharacterCategory::RELIGION],
            ['name' => 'Padre Marcelo Rossi', 'category_id' => CharacterCategory::RELIGION],
            ['name' => 'Edir Macedo', 'category_id' => CharacterCategory::RELIGION],
            ['name' => 'Silas Malafaia', 'category_id' => CharacterCategory::RELIGION],
            ['name' => 'Dalai Lama', 'category_id' => CharacterCategory::RELIGION],

            // Finanças
            ['name' => 'Abilio Diniz', 'category_id' => CharacterCategory::FINANCE],
            ['name' => 'Luiz Barsi', 'category_id' => CharacterCategory::FINANCE],
            ['name' => 'Warren Buffett', 'category_id' => CharacterCategory::FINANCE],

            // Ciência e tecnologia
            ['name' => 'Albert Einstein', 'category_id' => CharacterCategory::SCIENCE_AND_TECHNOLOGY],
            ['name' => 'Oswaldo Cruz', 'category_id' => CharacterCategory::SCIENCE_AND_TECHNOLOGY],
            ['name' => 'Marie Curie', 'category_id' => CharacterCategory::SCIENCE_AND_TECHNOLOGY],
            ['name' => 'Elon Musk', 'category_id' => CharacterCategory::SCIENCE_AND_TECHNOLOGY],
            ['name' => 'Steve Jobs', 'category_id' => CharacterCategory::SCIENCE_AND_TECHNOLOGY],
            ['name' => 'Mark Zuckerberg', 'category_id' => CharacterCategory::SCIENCE_AND_TECHNOLOGY],
            ['name' => 'Bill Gates', 'category_id' => CharacterCategory::SCIENCE_AND_TECHNOLOGY],
            ['name' => 'Marcos Pontes', 'category_id' => CharacterCategory::SCIENCE_AND_TECHNOLOGY],
            ['name' => 'Drauzio Varella', 'category_id' => CharacterCategory::SCIENCE_AND_TECHNOLOGY],

            // Televisão
            ['name' => 'Erick Jacquin', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'Paola Carosella', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'Henrique Fogaça', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'Silvio Santos', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'Faustão', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'Luciano Huck', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'Ana Maria Braga', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'Hebe Camargo', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'William Bonner', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'Fátima Bernardes', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'José Luiz Datena', 'category_id' => CharacterCategory::TELEVISION],
            ['name' => 'Mauricio Maia', 'category_id' => CharacterCategory::TELEVISION],

            // Mundo fictício
            ['name' => 'Zé Pequeno', 'category_id' => CharacterCategory::FICTION],
            ['name' => 'Capitão Nascimento', 'category_id' => CharacterCategory::FICTION],
            ['name' => 'Senna (Carandiru)', 'category_id' => CharacterCategory::FICTION],
            ['name' => 'Seu Madruga', 'category_id' => CharacterCategory::FICTION],
            ['name' => 'Chaves', 'category_id' => CharacterCategory::FICTION],
            ['name' => 'Mônica', 'category_id' => CharacterCategory::FICTION],
            ['name' => 'Cebolinha', 'category_id' => CharacterCategory::FICTION],
            ['name' => 'Bob Esponja', 'category_id' => CharacterCategory::FICTION],
            ['name' => 'Mickey Mouse', 'category_id' => CharacterCategory::FICTION],
            ['name' => 'Homer Simpson', 'category_id' => CharacterCategory::FICTION],

            // Arte
            ['name' => 'Wagner Moura', 'category_id' => CharacterCategory::ART],
            ['name' => 'Lázaro Ramos', 'category_id' => CharacterCategory::ART],
            ['name' => 'Tony Ramos', 'category_id' => CharacterCategory::ART],
            ['name' => 'Rodrigo Santoro', 'category_id' => CharacterCategory::ART],
            ['name' => 'Fernanda Montenegro', 'category_id' => CharacterCategory::ART],
            ['name' => 'Taís Araújo', 'category_id' => CharacterCategory::ART],
            ['name' => 'Camila Pitanga', 'category_id' => CharacterCategory::ART],
            ['name' => 'Regina Casé', 'category_id' => CharacterCategory::ART],
            ['name' => 'Roberto Carlos', 'category_id' => CharacterCategory::ART],
            ['name' => 'Caetano Veloso', 'category_id' => CharacterCategory::ART],
            ['name' => 'Gilberto Gil', 'category_id' => CharacterCategory::ART],
            ['name' => 'Zeca Pagodinho', 'category_id' => CharacterCategory::ART],
            ['name' => 'Michael Jackson', 'category_id' => CharacterCategory::ART],
            ['name' => 'Anitta', 'category_id' => CharacterCategory::ART],
            ['name' => 'Elis Regina', 'category_id' => CharacterCategory::ART],
            ['name' => 'Marília Mendonça', 'category_id' => CharacterCategory::ART],
            ['name' => 'Ivete Sangalo', 'category_id' => CharacterCategory::ART],
            ['name' => 'Tom Jobim', 'category_id' => CharacterCategory::ART],
            ['name' => 'Chico Buarque', 'category_id' => CharacterCategory::ART],
            ['name' => 'Fernando Meirelles', 'category_id' => CharacterCategory::ART],
            ['name' => 'Walter Salles', 'category_id' => CharacterCategory::ART],
            ['name' => 'Steven Spielberg', 'category_id' => CharacterCategory::ART],
            ['name' => 'Chico Anysio', 'category_id' => CharacterCategory::ART],
            ['name' => 'Renato Aragão', 'category_id' => CharacterCategory::ART],
            ['name' => 'Tirullipa', 'category_id' => CharacterCategory::ART],
            ['name' => 'Fábio Porchat', 'category_id' => CharacterCategory::ART],
            ['name' => 'Sócrates', 'category_id' => CharacterCategory::ART],
            ['name' => 'Platão', 'category_id' => CharacterCategory::ART],
            ['name' => 'Friedrich Nietzsche', 'category_id' => CharacterCategory::ART],
            ['name' => 'Machado de Assis', 'category_id' => CharacterCategory::ART],
            ['name' => 'Jorge Amado', 'category_id' => CharacterCategory::ART],
            ['name' => 'Clarice Lispector', 'category_id' => CharacterCategory::ART],
            ['name' => 'Paulo Coelho', 'category_id' => CharacterCategory::ART],
            ['name' => 'Carlos Drummond de Andrade', 'category_id' => CharacterCategory::ART],
            ['name' => 'Vinicius de Moraes', 'category_id' => CharacterCategory::ART],
            ['name' => 'Cecília Meireles', 'category_id' => CharacterCategory::ART],
            ['name' => 'Tarsila do Amaral', 'category_id' => CharacterCategory::ART],
            ['name' => 'Cândido Portinari', 'category_id' => CharacterCategory::ART],
            ['name' => 'Pablo Picasso', 'category_id' => CharacterCategory::ART],
            ['name' => 'Aleijadinho', 'category_id' => CharacterCategory::ART],
            ['name' => 'Victor Brecheret', 'category_id' => CharacterCategory::ART],
            ['name' => 'Sebastião Salgado', 'category_id' => CharacterCategory::ART],
            ['name' => 'Alok', 'category_id' => CharacterCategory::ART],
            ['name' => 'Vintage Culture', 'category_id' => CharacterCategory::ART],
            ['name' => 'Gisele Bündchen', 'category_id' => CharacterCategory::ART],
            ['name' => 'Adriana Lima', 'category_id' => CharacterCategory::ART],
            ['name' => 'Oskar Metsavaht', 'category_id' => CharacterCategory::ART],
            ['name' => 'David Copperfield', 'category_id' => CharacterCategory::ART],
            ['name' => 'Carlinhos de Jesus', 'category_id' => CharacterCategory::ART],
        ];

        foreach ($characters as $character) {
            DB::table('characters')->updateOrInsert([
                'name' => $character['name'],
            ], [
                'picture' => '',
                'category_id' => $character['category_id']->value,
            ]);
        }
    }
}
