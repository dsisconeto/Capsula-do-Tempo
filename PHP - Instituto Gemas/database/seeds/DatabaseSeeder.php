<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Permissoes::class);
        $this->call(UsuarioInicial::class);
        $this->call(Informacoes::class);
        $this->call(Slide::class);
    }
}
