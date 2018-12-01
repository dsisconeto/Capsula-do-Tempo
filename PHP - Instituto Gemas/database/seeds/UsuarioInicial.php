<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsuarioInicial extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Dejair Sisconeto',
            'email' => 'dejairsisconeto23@gmail.com',
            'password' => bcrypt('gemas*alpha'),
            'permissoes_id' => 1
        ]);



    }


}
