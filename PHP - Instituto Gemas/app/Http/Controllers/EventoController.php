<?php

namespace App\Http\Controllers;

use App\Evento;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Http\Request;


class EventoController extends Controller
{
    use SEOToolsTrait;
    private $evento;


    public function __construct(Evento $evento)
    {
        $this->evento = $evento;
    }

    public function index()
    {

        $eventos = $this->evento->where("status", "=", 1)->paginate(9);

        $this->seo()->setTitle('Eventos - Instituto Gemas - Gestão Meio Ambiente e Sociedade');
        $this->seo()->setDescription('Eventos - Instituto Gemas - Gestão Meio Ambiente e Sociedade');
   
        $this->seo()->opengraph()->addProperty('type', 'website');
        $this->seo()->twitter()->setSite('@institutogemas');


        return view("eventos")->with("eventos", $eventos);
    }

    public function show($slug, $id, Request $request)
    {


        $evento = $this->evento->where("id", "=", $id)
            ->where("status", "=", 1)
            ->get()->first();


        $this->seo()->setTitle($evento->nome . ' - Instituto Gemas - Gestão Meio Ambiente e Sociedade');
        $this->seo()->setDescription($evento->nome . ' - Instituto Gemas - Gestão Meio Ambiente e Sociedade');
    
        $this->seo()->opengraph()->addProperty('type', 'article');
        $this->seo()->twitter()->setSite('@institutogemas');


        return view("evento")->with("evento", $evento);


    }

}
