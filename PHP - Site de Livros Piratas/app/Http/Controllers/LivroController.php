<?php

namespace App\Http\Controllers;

use App\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{


    public function index(Request $request, Livro $livro)
    {

        $query = $livro->query();
        if ($request->has('nome')) {
            $query->where("nome", 'LIKE', "%{$request->input('nome')}%");
        } else {
            $query->orderBy('id', 'DESC');
        }

        $livros = $query->paginate(30);

        return view('home', compact('livros'));
    }

    public function store(Request $request)
    {
        $livro = new Livro();
        $capaFile = $request->file('capa');
        $livro->nome = $request->input('nome');
        $livro->descricao = $request->input('descricao');
        $livro->link_azw = $request->input('link_azw');
        $livro->link_epub = $request->input('link_epub');
        $livro->link_pdf = $request->input('link_pdf');
        $livro->capa = uniqid('capa_') . "." . $capaFile->getClientOriginalExtension();
        $capaFile->storeAs("/capas", $livro->capa);
        $livro->save();
        return back();
    }


    public function create()
    {
        return view('livro.cadastrar');
    }

    public function show($any, Livro $livro)
    {
        return view('livro.show', compact('livro'));
    }
}
