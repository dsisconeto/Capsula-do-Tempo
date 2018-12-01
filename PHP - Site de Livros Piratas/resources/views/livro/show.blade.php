@extends('layout')
@section('titulo')
    {{$livro->nome}}
@endsection
@section('conteudo')

    <style>
        .download {
            width: 100%;
            display: block;
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;
            margin-top: 20px;
        }
    </style>

    <div class="row">
        <div class="col-md-4">
            <img style="width: 100%;" src="{{asset("/storage/capas/{$livro->capa}")}}" class="img-fluid"
                 alt="Baixar Livro {{$livro->nome}}">
        </div>
        <div class="col-md-8">
            <p class="text-justify">
                {{$livro->descricao}}
            </p>

            @if($livro->link_pdf)
                <a class="download"
                   href="{{$livro->link_pdf}}">
                    Baixar em PDF</a>
            @endif

            @if(!$livro->link_epub)
                <a class="download" href="{{$livro->link_pdf}}"> Baixar em EPUB</a>
            @endif

            @if(!$livro->link_azw)
                <a class="download" href="{{$livro->link_pdf}}"> Baixar em AZW</a>
            @endif
        </div>
    </div>

@endsection
