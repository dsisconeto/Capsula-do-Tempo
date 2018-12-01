<?php

use Illuminate\Database\Seeder;

class Slide extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('informacoes')->insert([
            'id' => 2,
            'nome' => "Slide",
            'dados' => "",
        ]);

    }
}
