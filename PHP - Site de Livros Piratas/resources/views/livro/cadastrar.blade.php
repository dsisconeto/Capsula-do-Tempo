@extends('layout')
@section('titulo')
    Cadastrar Livros
@endsection
@section('conteudo')

    <form action="{{route('livro.post')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required class="form-control" id="nome">
            </div>
            <div class="form-group col-md-6">
                <label for="capa">Capa:</label>
                <input type="file" name="capa" id="capa" required class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="descricao">Descricao:</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="10" required></textarea>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
                <label for="link_pdf">Link PDF:</label>
                <input type="text" name="link_pdf" id="link_pdf" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="link_epub">Link EPUB:</label>
                <input type="text" name="link_epub" id="link" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="link_azw">Link AZW:</label>
                <input type="text" name="link_azw" id="link" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12 ">
                <button type="submit" class="btn btn-primary float-right">
                    Cadastrar
                </button>
            </div>
        </div>
    </form>
@endsection
