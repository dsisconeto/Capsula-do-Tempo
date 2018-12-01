@extends('admin.evento.layout')

@section("title") Capa do Evento @endsection

@section('css')
    <link rel="stylesheet" href="/admin_dist/vendor/Jcrop/css/Jcrop.min.css">
    <style>
        .jcrop-tracker {
            margin: 0 auto;
            float: none;
        }
    </style>
@endsection

@section('js')
    <script src="/admin_dist/vendor/Jcrop/js/Jcrop.min.js"></script>
    <script type="text/javascript">


    </script>
@endsection

@section('content')

    <form action="{{route("admin.evento.capa.update", $evento->id)}}" method="post" enctype="multipart/form-data">
        {!! csrf_field()  !!}
        {!! method_field("PUT") !!}
        <div class="form-group row">
            <div class="col-md-12">
                <label for="capa">Arquivo de Capa: tamanho máximo 1MB, Tamanho de Imagem 1050x750</label>
                <input type="file" class="form-control" name="capa" required="required">
            </div>
        </div>
        <button type="submit" class="btn btn-primary form-control">Upload</button>
    </form>
    <br>
    @if($evento->capa)

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1 class="text-center">
                    Capa atual
                </h1>
                <img src="{{asset("/storage/image/evento/capa/thumbnail/".$evento->capa)}}"
                     class="img-responsive center-block">
            </div>
        </div>

    @endif
    <hr>
@endsection