@extends('admin.layout')


@section("title") Informações do Site @endsection

@section('css')

@endsection

@section('js')
    <script src="/admin_dist/vendor/ckeditor/ckeditor.js"></script>
    <script src="/admin_dist/js/page/informacoes.js"></script>

@endsection


@section('content')

    <form action="{{route("admin.informacoes.sobre")}}" method="post">
        {{ csrf_field() }}
        <input type="hidden" value="PUT" name="_method">

        <div class="form-group row">
            <div class="col-md-12">
                <label for="rodape"> Rodapé: </label>
                <input type="text" name="rodape" id="rodape" class="form-control" required="required"
                       value="@if(old("rodape")){{old("rodape")}}@else{{$dados["rodape"]}}@endif">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="endereco"> Endereço </label>
                <input type="text" name="endereco" id="endereco" class="form-control" required="required"
                       value="@if(old("endereco")){{old("endereco")}}@else{{$dados["endereco"]}}@endif">
            </div>

            <div class="col-md-6">
                <label for="maps"> Embed do Google Maps: </label>
                <input type="text" name="maps" id="maps" class="form-control" required="required"
                       value="@if(old("maps")){{old("maps")}}@else{{$dados["maps"]}}@endif">
            </div>


        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="cnpj"> CNPJ: </label>
                <input type="text" name="cnpj" id="cnpj" class="form-control" required="required"
                       value="@if(old("cnpj")){{old("cnpj")}}@else{{$dados["cnpj"]}}@endif">
            </div>

            <div class="col-md-4">
                <label for="email">Email: </label>
                <input type="text" name="email" id="email" class="form-control" required="required"
                       value="@if(old("email")){{old("email")}}@else{{$dados["email"]}}@endif">
            </div>

            <div class="col-md-4">
                <label for="telefones">Telones: </label>
                <input type="text" name="telefones" id="telefones" class="form-control" required="required"
                       value="@if(old("telefones")){{old("telefones")}}@else{{$dados["telefones"]}}@endif">
            </div>
        </div>


        <div class="form-group row">

            <div class="col-md-4">
                <label for="instagram"> Instagram: </label>
                <input type="text" name="instagram" id="instagram" class="form-control" required="required"
                       value="@if(old("instagram")){{old("instagram")}}@else{{$dados["instagram"]}}@endif">
            </div>

            <div class="col-md-4">
                <label for="facebook"> Facebook: </label>
                <input type="text" name="facebook" id="facebook" class="form-control" required="required"
                       value="@if(old("facebook")){{old("facebook")}}@else{{$dados["facebook"]}}@endif">
            </div>

            <div class="col-md-4">
                <label for="facebook"> Twitter: </label>
                <input type="text" name="twitter" id="twitter" class="form-control" required="required"
                       value="@if(old("twitter")){{old("twitter")}}@else{{$dados["twitter"] or ""}}@endif">
            </div>
        </div>


        <div class="form-group row">
            <div class="col-md-12">
                <label for="sobre"> Sobre o Instituto:</label>
                <textarea name="sobre" id="sobre" class="form-control"
                          required="required"> @if(old("sobre")){{old("sobre")}}@else{{$dados["sobre"]}}@endif</textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right">
                    Enviar
                </button>
            </div>
        </div>
    </form>

@endsection