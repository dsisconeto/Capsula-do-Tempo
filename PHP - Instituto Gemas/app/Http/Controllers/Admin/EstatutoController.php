<?php

namespace App\Http\Controllers\Admin;

use App\Informacoes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EstatutoController extends Controller
{

    private $estatuto;
    private $path = "documentos/";

    public function __construct(Informacoes $informacoes)
    {
        $this->estatuto = $informacoes->find(3);

    }

    public function index()
    {
        return view("admin.estatuto.index")->with("estatuto", $this->estatuto->getDados());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            "estatuto" => "mimes:pdf|required|max:2000"
        ]);

        $file = $request->file("estatuto");
        $name = md5(uniqid(time())) . "." . $file->getClientOriginalExtension();
        $estatuto = $this->estatuto->getDados();
        $file->storeAs($this->path, $name);
        if (isset($estatuto["pdf"]) && $estatuto["pdf"]) {
            Storage::delete($this->path . $estatuto["pdf"]);
        }

        $estatuto["pdf"] = $name;
        $this->estatuto->setDados($estatuto);
        $this->estatuto->save();

        return redirect()->back()->with("success", "Estatuto enviado com sucesso");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
