<?php

use Illuminate\Database\Seeder;

class Informacoes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dados = [
            "email" => "Institutogemas2011@hotmail.com",
            "rodape" => "",
            "endereco" => "",
            "maps" => "!1m18!1m12!1m3!1d3927.0129212086217!2d-48.361754490809616!3d-10.179604671053479!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa1e2d2ad6eb59a98!2sUFT+-+Universidade+Federal+do+Tocantins+-+C%C3%A2mpus+de+Palmas+e+Reitoria!5e0!3m2!1spt-BR!2sbr!4v1504244606064",
            "cnpj" => "",
            "instagram" => "https://www.instagram.com/institutogemas/",
            "facebook" => "https://www.instagram.com/institutogemas/",
            "twitter" => "https://www.instagram.com/institutogemas/",
            "sobre" => "",
            "telefones" => "(63) 3223-6346"
        ];

        DB::table('informacoes')->insert([
            'id' => 1,
            'nome' => "Informações Gerais",
            'dados' => json_encode($dados),
        ]);

        DB::table('informacoes')->insert([
            'id' => 3,
            'nome' => "Estatuto",
            'dados' => json_encode(["pdf"=>""]),
        ]);

    }
}
