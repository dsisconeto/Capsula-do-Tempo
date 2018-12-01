<?php

namespace App\Http\Controllers;

use App\Informacoes;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class EstatutoController extends Controller
{
    private $estatuto;
    use SEOToolsTrait;

    public function __construct(Informacoes $informacoes)
    {
        $this->estatuto = $informacoes->findEstatuto();
    }

    public function index()
    {
        $this->seo()->setTitle('Estatuto do Instituto Gemas em PDF - Gestão Meio Ambiente e Sociedade');
        $this->seo()->setDescription('Estatuto do Instituto Gemas em PDF - Gestão Meio Ambiente e Sociedade');
        $this->seo()->opengraph()->addProperty('type', 'article');

        return view("estatuto")->with("estatuto", $this->estatuto->getDados());
    }
}
