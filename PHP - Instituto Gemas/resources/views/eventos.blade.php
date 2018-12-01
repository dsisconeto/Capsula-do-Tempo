@extends("layout.main")

@section("container")
    <div class="container">
        <h1 class="title">Todos os Eventos</h1>
        <div class="row">
            @foreach($eventos as $evento)
                <div class="col-md-4">
                    <a href="{{route("evento", [$evento->slug, $evento->id])}}" class="evento-box">
                        <div class="evento-box-content">
                            <img src="{{asset("/storage/image/evento/capa/thumbnail/{$evento->capa}")}}">
                            <div class="evento-box-text">
                                <p class="evento-box-title">{{$evento->nome}}</p>
                                <p class="evento-box-sub-title">{{$evento->data->format('d \\d\\o m \\d\\e  Y')}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                {{$eventos->links()}}
            </div>
        </div>
    </div>
@endsection