@extends('layout')
@section('titulo')
    Lista de Livros
@endsection
@section('conteudo')

    <form action="" method="GET">
        <div class="row">

            <div class="form-group col-md-10">
                <label for="nome">Nome do Livro</label>
                <input type="text" class="form-control" name="nome" id="nome">
            </div>
            <div class="form-group col-md-2">

                <button style="margin-top: 30px" type="submit" class="btn btn-primary">
                    Pesquisar
                </button>
            </div>

        </div>
    </form>
    <hr>
    <div class="row">

        <div class="col-md-12">
            {{$livros->links()}}
        </div>
        @foreach($livros as $livro)
            <div class="col-md-3">
                <div class="card" style="width: 100%; margin-bottom: 20px">
                    <img class="card-img-top img-fluid" src="{{asset("/storage/capas/{$livro->capa}")}}"
                         alt="Baixar Livro de Computação {{$livro->nome}}}">
                    <div class="card-body">
                        <a href="/livros/baixar-livro-{{str_slug($livro->nome)}}/{{$livro->id}}" class="text-center">
                            Baixar Livro {{$livro->nome}}
                        </a>
                    </div>
                </div>
            </div>

        @endforeach

        <div class="col-md-12">
            {{$livros->links()}}
        </div>
    </div>

@endsection
