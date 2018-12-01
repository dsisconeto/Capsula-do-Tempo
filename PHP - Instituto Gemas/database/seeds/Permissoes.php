<?php

use Illuminate\Database\Seeder;

class Permissoes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissoes')->insert([
            'id' => '1',
            'nome' => "root",
            'permissoes' => json_encode([true, true, true, true]),
        ]);
        DB::table('permissoes')->insert([
            'id' => '2',
            'nome' => "conteudo",
            'permissoes' => json_encode([false, false, true, true]),
        ]);

        DB::table('permissoes')->insert([
            'id' => '3',
            'nome' => "evento",
            'permissoes' => json_encode([false, false, true, false]),
        ]);

        DB::table('permissoes')->insert([
            'id' => '4',
            'nome' => "post",
            'permissoes' => json_encode([false, false, false, true]),
        ]);

        DB::table('permissoes')->insert([
            'id' => '5',
            'nome' => "informacoes",
            'permissoes' => json_encode([false, true, false, false]),
        ]);
    }
}
