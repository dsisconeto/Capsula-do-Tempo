<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informacoes extends Model
{
    protected $table = "informacoes";


    /**
     * @return array
     */
    public function getDados()
    {
        if ($this->dados == null) {
            return [];
        }
        return json_decode($this->dados, true);
    }

    public function setDados(Array $dados)
    {
        $this->dados = json_encode($dados);
        return $this;
    }

    public function findEstatuto()
    {
        return $this->find(3);
    }
}
