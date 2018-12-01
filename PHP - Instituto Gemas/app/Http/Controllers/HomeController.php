<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Informacoes;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use SEOToolsTrait;

    private $slide;

    public function __construct(Informacoes $informacoes)
    {
        $this->slide = $informacoes->find(2);

    }

    public function pesquisar(Request $request)
    {
        $this->validate($request, [
            'q' => 'required|min:2'
        ]);


        $q = $request->get('q');

        $this->seo()->setTitle('Pesquisa por ' . $q . ' - Gestão Meio Ambiente e Sociedade');
        $this->seo()->setDescription('Pesquisa por ' . $q . ' - Gestão Meio Ambiente e Sociedade');
        $this->seo()->opengraph()->addProperty('type', 'search');

        return view('pesquisar')->with('q', $q);
    }

    public function index(Evento $evento)
    {

        $eventos = $evento->where("status", "=", 1)
            ->limit("9")
            ->orderBy("data", "DESC")
            ->get();


        $this->seo()->setTitle('Instituto Gemas - Gestão Meio Ambiente e Sociedade');
        $this->seo()->setDescription('Instituto Gemas - Gestão Meio Ambiente e Sociedade');
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite('@institutogemas');


        return view('home')
            ->with("slides", $this->slide->getDados())
            ->with("eventos", $eventos);
    }


}
