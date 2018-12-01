@extends("admin.evento.layout")

@push('css')
    <style>
        .galleria ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .galleria li {
            display: block;
            margin-bottom: 20px;
        }

        .galleria-box {
            width: 100%;
            float: left;
            border: 1px solid #ccc;
        }

        .galleria button {
            width: 100%;
            border-radius: 0;
        }
    </style>
@endpush

@section('js')



@endsection





@section("title")
    Galeria de Fotos - {{$evento->nome}}
@endsection


@section('content')

    <form action="{{route("admin.evento.galeria.update", $evento->id)}}" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {!! method_field("PUT") !!}

        <div class="row form-group">
            <label for="imagens">Imagem da Galeria: Tamanho 1200X675</label>
            <input type="file" name="imagens[]" id="imagens" multiple class="form-control">
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right">
                    Enviar
                </button>
            </div>
        </div>

    </form>

    <h2>Imagens da Galaria</h2>
    <hr>
    <div class="galleria ">
        <ul class="row">
            @forelse($galerias as $key => $galeria)
                <li class="col-md-4">
                    <div class="galleria-box">
                        <img src="{{asset("storage/image/evento/galeria/thumbnail/$galeria")}}" class="img-responsive">
                        <form action="{{route("admin.evento.galeria.destroy", $key)}}" method="POST">
                            {!! csrf_field() !!}
                            {!! method_field("DELETE") !!}
                            <input type="hidden" value="{{$evento->id}}}" name="evento_id">
                            <button class="btn btn-danger" type="submit">
                                Deletar
                            </button>
                        </form>
                    </div>
                </li>
            @empty
                <li>Não existe fotos nesse evento</li>
            @endforelse
        </ul>

    </div>
@endsection