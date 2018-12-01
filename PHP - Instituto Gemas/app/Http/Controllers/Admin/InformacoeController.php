<?php

namespace App\Http\Controllers\Admin;

use App\Informacoes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformacoeController extends Controller
{

    private $informacoes;

    public function __construct(Informacoes $informacoes)
    {
        $this->informacoes = $informacoes->find(1);
    }

    public function index()
    {


        return view("admin.informacoe")
            ->with("dados", $this->informacoes->getDados());
    }


    public function sobre(Request $request)
    {

        $this->validate($request, [
            "email" => "required|email|max:250",
            "telefones" => "required",
            "rodape" => "required|max:300",
            "endereco" => "required|max:300",
            "cnpj" => "max:20",
            "instagram" => "url|max:300",
            "facebook" => "url|max:300",
            "twitter" => "url|max:300",
            "sobre" => "min:20|required"
        ]);


        $dados = $request->only(["email", "rodape", "endereco", "maps", "cnpj", "instagram", "facebook", "twitter", "sobre", "telefones"]);
        $this->informacoes->setDados($dados);
        $this->informacoes->save();

        return redirect()->back()->with("success", "Informações editada com sucesso.");

    }


}
