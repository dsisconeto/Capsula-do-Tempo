@extends("layout.main")


@push("css")
    <style>
        .evento-content-title {
            width: 100%;
            height: auto;
            background: #314a29;
            color: #fff;
            font-size: 60px;
            padding: 50px 0;
            text-align: center;
            margin: 0;
            font-family: gotham-black;
        }

        .evento-content-detalhes h3 {
            font-size: 30px;
            font-family: gotham-black;
            border-bottom: 1px solid #314a29;;
        }

        .evento-content-detalhes > ul {
            list-style-type: none;
            padding: 0;
        }

        .evento-content-detalhes ul > li {
            padding: 10px 0;
            margin-bottom: 10px;
            border-bottom: 1px dashed #314a29;;
        }

        .evento-content-detalhes ul > li > a {
            width: 100%;
            font-size: 20px;
        }

        .evento-content-image-box {
            width: 100%;
            height: auto;
            cursor: zoom-in;
            display: block;
            -webkit-box-shadow: 0px 6px 6px 0px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 0px 6px 6px 0px rgba(0, 0, 0, 0.75);
            box-shadow: 0px 6px 6px 0px rgba(0, 0, 0, 0.75);
            margin-bottom: 20px;
        }

        .galleria {
            margin-bottom: 100px;
        }


    </style>
@endpush

@push("js")
    <script src="{{asset(mix("/js/evento.js"))}}"></script>
@endpush

@section("title")
    {{$evento->nome}}
@endsection


@section("container")
    <h1 class="evento-content-title ">
        {{$evento->nome}}
        <br>

    </h1>
    <div class="container">
        <div class="row">
            <div class="col-md-3 evento-content-detalhes">
                <h3>
                    DETALHES
                </h3>
                <ul>
                    <li>
                        <strong>
                            <i class="fa fa-calendar-o" aria-hidden="true"></i>
                            Data:
                        </strong>
                        <br>
                        {{$evento->data->format('d \\d\\o m \\d\\e  Y')}}
                    </li>

                    <li>
                        <strong>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            Endereço:
                        </strong>
                        <br>
                        {{$evento->endereco}}
                    </li>
                    @if($evento->getGalleria())
                        <li>

                            <a href="#galeria" class="btn btn-primary" id="galeria-btn">
                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                                Fotos do Evento</a>
                        </li>
                    @endif
                </ul>


            </div>
            <div class="col-md-7">
                <img src="{{asset("storage/image/evento/capa/main/{$evento->capa}")}}"
                     class="img-responsive center-block">
                <hr>
                <h2>Sobre o Evento</h2>
                {!!  $evento->descricao !!}
            </div>
        </div>

        <div class="galleria" id="galeria">
            <h3 class="title">
                <i class="fa fa-picture-o" aria-hidden="true"></i>
                Galeria de Fotos
            </h3>
            <div class="row" id="galleria-content">
                @foreach($evento->getGalleria() as $key => $image )
                    <div class="col-md-4">
                        <a href="{{asset("/storage/image/evento/galeria/main/{$image}")}}"
                           class="evento-content-image-box">
                            <img src="{{asset("/storage/image/evento/galeria/thumbnail/{$image}")}}"
                                 class="img-responsive">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>




@endsection