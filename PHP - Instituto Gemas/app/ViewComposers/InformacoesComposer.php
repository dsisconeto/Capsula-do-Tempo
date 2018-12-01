<?php


namespace App\ViewComposers;


use App\Informacoes;

class InformacoesComposer
{
    private $informacoes;

    public function __construct(Informacoes $informacoes)
    {
        $this->informacoes = $informacoes->find(1);

    }

    public function compose($view)
    {
        $view->with("informacoes", $this->informacoes->getDados());

    }

}