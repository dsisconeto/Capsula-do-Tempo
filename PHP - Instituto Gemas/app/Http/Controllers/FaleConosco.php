<?php

namespace App\Http\Controllers;

use App\Informacoes;
use Illuminate\Http\Request;
use \Mail;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class FaleConosco extends Controller
{
    use SEOToolsTrait;
    private $informacoes;

    public function __construct(Informacoes $informacoes)
    {
        $this->informacoes = $informacoes->find(1);
    }

    public function confirmado()
    {
        if (session('mensagem')) {

            $this->seo()->setTitle('E-mail enviado com sucesso');
            $this->seo()->setDescription('E-mail enviado com sucesso');
            $this->seo()->opengraph()->addProperty('type', 'website');
            return view('confirmaEnvioEmail');

        } else {

            return redirect()->route('home');
        }
    }


    public function sendEmail(Request $request)
    {
        $this->validate($request, [
            "nome" => "required|min:2|max:100",
            "email" => "email|required",
            "assunto" => "required|min:10|max:100",
            "mensagem" => "required|min:20|max:1000"

        ]);

        $dataForm = $request->only(['nome', 'email', 'assunto', 'mensagem']);
        Mail::to($this->informacoes->getDados()["email"])->send(new \App\Mail\FaleConosco($dataForm));

        $respota['nome'] = 'Instituto Gemas';
        $respota["email"] = $this->informacoes->getDados()["email"];
        $respota['assunto'] = 'E-mail Respota';
        $respota['mensagem'] = 'E-mail enviado para confirmar que seu contato foi feito com sucesso.';
        $mensagem = '';
        if (Mail::to($dataForm['email'])->send(new \App\Mail\FaleConosco($respota))) {
            $mensagem = 'Email Enviado com sucesso, em breve entraremos em contato.';

        } else {
            $mensagem = 'Email Enviado com sucesso, em breve entraremos em contato.';

        }
        return redirect()
            ->route('faleconosco.enviado')
            ->with('mensagem', $mensagem);

    }
}
