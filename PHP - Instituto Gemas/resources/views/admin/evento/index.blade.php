@extends('admin.evento.layout')

@section("title") Eventos @endsection

@push('css')
    <style>
        .form-delete {
            width: auto;
            height: auto;
            display: inline;
            background: transparent;
            border: 0;
            box-sizing: border-box;
            padding: 0;
        }

        .btn-delete {
            width: auto;
            height: auto;
            display: inline;
            background: transparent;
            border: 0;
            box-sizing: border-box;
            padding: 0;
        }

        .btn-delete:hover {
            text-decoration: underline;
        }

        .form-status {
            width: auto;
            height: auto;
            display: inline;
            background: transparent;
            border: 0;
            box-sizing: border-box;
            padding: 0;
        }

        .form-status button {
            width: auto;
            height: auto;
            display: inline;
            background: transparent;
            border: 0;
            box-sizing: border-box;
            padding: 0;
        }

        .form-status button:hover {
            text-decoration: underline;
        }

    </style>
@endpush

@section('js')
    <script>
        $(".form-delete").submit(function (event) {

            if(!confirm("Tem certeza que deseja deletar esse item ?")){ggit
                event.preventDefault();
            }


        });
    </script>
@endsection


@section('content')

    <form method="get">
        <div class="row form-group">
            <div class="col-md-12">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{$nome}}"
                       placeholder="Pesquisar pelo nome do evento" required="required" minlength="1">
            </div>
        </div>

    </form>


    <table class="table table-bordered table-striped">

        <thead>
        <tr>
            <th>Nome:</th>
            <th>Data:</th>
            <th>Status:</th>
            <th class="col-md-4">Ações:</th>
        </tr>
        </thead>
        <tbody>
        @foreach($eventos as $evento)
            <tr class="@if($evento->status == 0) danger @else success @endif">
                <td>{{$evento->nome}}</td>
                <td>{{ Carbon\Carbon::parse($evento->data)->format('d/m/Y H:m:s') }}</td>

                <td>@if($evento->status == 1)Publicado @else Salvo @endif</td>

                <td class="text-center">


                    <form action="{{route("admin.evento.status", $evento->id)}}" method="POST" class="form-status">
                        {!! csrf_field() !!}
                        {!! method_field("PUT") !!}
                        @if($evento->status == 1)
                            <button class="btn text-danger">
                                Despublicar
                            </button>
                        @else
                            <button class="btn text-info">
                                Públicar
                            </button>

                        @endif

                    </form>
                    |
                    <a href="{{ route('admin.evento.edit',  $evento->id) }}">
                        Editar
                    </a> |
                    <a href="{{ route('admin.evento.capa.edit',  $evento->id) }}">
                        Capa
                    </a> |
                    <a href="{{ route('admin.evento.galeria.edit',  $evento->id) }}">
                        Galeria
                    </a> |
                    <form class="form-delete" action="{!! route('admin.evento.destroy', [ $evento->id]) !!}"
                          method="POST">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn-delete text-danger">
                            Deletar
                        </button>
                    </form>

                </td>
            </tr>
        @endforeach


        </tbody>
    </table>
    {!! $eventos->links() !!}



@endsection