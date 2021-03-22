<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Obs: Apesar de o ID poder ser gerado pelo banco, gosto de defini-lo aqui pois assim fica fácil consultar
        qual é o ID de determinada escolaridade
        */

        DB::table('education_levels')->insert([
            ['id' => 1, 'name' => 'Ensino Fundamental (1º grau)'],
            ['id' => 2, 'name' => 'Curso extra-curricular / Profissionalizante '],
            ['id' => 3, 'name' => 'Ensino Médio (2º Grau)'],
            ['id' => 4, 'name' => 'Curso Técnico'],
            ['id' => 5, 'name' => 'Ensino Superior'],
            ['id' => 6, 'name' => 'Pós-graduação - Especialização/MBA'],
            ['id' => 7, 'name' => 'Pós-graduação - Mestrado'],
            ['id' => 8, 'name' => 'Pós-graduação - Doutorado'],
        ]);
    }
}
