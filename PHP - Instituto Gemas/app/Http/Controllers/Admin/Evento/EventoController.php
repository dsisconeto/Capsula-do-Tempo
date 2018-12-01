<?php

namespace App\Http\Controllers\Admin\Evento;

use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Evento;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $evento;

    public function __construct(Evento $evento)
    {
        $this->evento = $evento;
    }

    public function index(Request $request)
    {
        $nome = "";
        if ($request->has("nome") && strlen($request->get("nome")) > 1) {
            $nome = $request->get("nome");
            $eventos = $this->evento->where('nome', 'like', "%{$nome}%")->orderBy('created_at', "DESC")->paginate(10);
        } else {
            $eventos = $this->evento->orderBy('created_at', "DESC")->paginate(10);
        }
        return view("admin.evento.index", compact(['eventos', $eventos], ["nome", $nome]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.evento.administrar");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->evento->rules());
        $dataForm = $request->all();
        $slug = str_slug($dataForm["nome"], "-");
        $count = 1;
        $newSlug = $slug;
        do {
            $eventos = $this->evento->where("slug", "=", $newSlug)
                ->limit(1)
                ->get();
            if ($eventos->count()) {
                $newSlug = $slug . "-" . $count;
                $count++;
            }
        } while ($eventos->count());
        $this->evento->usuario_id = Auth::user()->getAuthIdentifier();
        $this->evento->nome = $dataForm["nome"];
        $this->evento->slug = $newSlug;
        $this->evento->descricao = $dataForm["descricao"];
        $this->evento->endereco = $dataForm["endereco"];
        $this->evento->setData($dataForm["data"]);;
        if ($this->evento->save()) {
            return redirect()->route("admin.evento.capa.edit", [$this->evento->id]);
        } else {
            return redirect()->back()->with("danger", "Não foi possivel cadastrar")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evento = $this->evento->find($id);
        return view("admin.evento.administrar", compact(["evento", $evento]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->evento->rules());
        $dataForm = $request->only(['nome', 'descricao', 'endereco', 'data']);
        $this->evento = $this->evento->find($id);
        $this->evento->nome = $dataForm["nome"];
        $this->evento->descricao = $dataForm["descricao"];
        $this->evento->endereco = $dataForm["endereco"];
        $this->evento->setData($dataForm["data"]);
        if ($this->evento->update()) {
            return redirect()->route('admin.evento.index')->with("success", "Evento editado com sucesso");
        } else {
            return redirect()->route('admin.evento.index')->with("danger", "Não foi possivel editar o evento");
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $this->evento = $this->evento->find($id);
        if ($this->evento->status) {
            $this->evento->status = 0;
        } else {
            $this->evento->status = 1;
            if ($this->evento->capa == NULL) {
                return redirect()->back()->with("danger", "O evento não tem capa");
            }
        }
        $this->evento->save();
        if ($this->evento->status) {
            return redirect()->back()->with("success", "Evento públicado com sucesso");
        } else {
            return redirect()->back()->with("danger", "Evento despublicado com sucesso");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->evento->destroy($id)) {
            return redirect()->back()->with("success", "Evento deletado com sucesso");
        } else {
            return redirect()->back()->with("danger", "Não foi possivel deletar o evento");
        }
    }
}