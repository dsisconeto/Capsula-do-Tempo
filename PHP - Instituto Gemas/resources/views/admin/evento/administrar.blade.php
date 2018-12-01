@extends('admin.evento.layout')

@section("title")
    @if(isset($evento))
        Editar Evento - {{$evento->nome}}
    @else
        Cadastrar Evento
    @endif
@endsection

@section('css')

@endsection

@section('js')
    <script src="/admin_dist/vendor/ckeditor/ckeditor.js"></script>
    <script src="/admin_dist/js/page/evento/administrar.js"></script>
@endsection


@section('content')

    <form method="post"
          action="@if(isset($evento)){{route('admin.evento.update', $evento->id)}}@else{{route('admin.evento.store')}}@endif">
        {{ csrf_field() }}
        @if(isset($evento))

            <input type="hidden" value="PUT" name="_method">
        @endif

        <div class="row form-group">
            <div class="col-md-12">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{$evento->nome or old('nome') }}"
                       required="required" maxlength="150" minlength="5">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-9">
                <label for="endereco">Endereço:</label>
                <input type="text" name="endereco" id="endereco" class="form-control"
                       value="{{$evento->endereco or old('endereco')}}"
                       required="required" maxlength="250" minlength="2">
            </div>

            <div class="col-md-3">
                <label for="data">Data:</label>
                <input type="datetime-local" name="data" id="data" class="form-control" required="required"
                       value="@if(isset($evento)){{Carbon\Carbon::parse($evento->data)->format('Y-m-d\TH:m:s')}}@else{{old('data')}}@endif">
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" name="descricao" id="descricao" required="required"
                          minlength="5">{{$evento->descricao or old('descricao')}}</textarea>
            </div>
        </div>


        <div class="row form-group">

            <div class="col-md-12">

                <button type="submit" class="btn btn-primary form-control">
                    @if(isset($evento))
                        {{"Editar"}} @else
                        {{"Cadastrar"}} @endif</button>
            </div>
        </div>
    </form>



@endsection