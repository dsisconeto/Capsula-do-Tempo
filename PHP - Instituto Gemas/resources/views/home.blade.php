@extends("layout.main")
@push("js")

    <script src="{{asset(mix('/js/home.js'))}}"></script>
@endpush

@section("title")
    Instituto Gemas
@endsection
@section("container")

    @if($slides)
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                @foreach($slides as $slide)
                    <li data-target="#carousel-example-generic" data-slide-to="{{$loop->index}}"
                        @if($loop->index == 0)class="active" @endif></li>
                @endforeach
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @foreach($slides as $slide)
                    <div class="item @if($loop->index == 0) active @endif">
                        <a href="@if($slide["link"]){{$slide["link"]}}@else#@endif">
                            <img src="{{asset("storage/image/slide/main/{$slide["image"]}")}}"
                                 alt="Imagem do Slide"
                                 class="img-responsive">
                            <div class="carousel-caption">
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">Eventos</h1>
                <p class="sub-title">Confira nosso eventos</p>
            </div>
        </div>


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

        <div class=row>
            <div class="col-md-4 col-md-offset-4">
                <a href="{{route("eventos")}}" class="btn btn-primary veja-mais ">Veja Mais Eventos</a>
            </div>
        </div>


        <div class="row" id="quem-somos">
            <div class="col-md-12">
                <h1 class="title">Quem Somos?</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="quem-somos">
                    <img src="{{asset(mix("img/quem-somos.png"))}}" class="img-responsive"
                         style="float: left; padding:  0 10px 10px  0">
                    {!!  $informacoes["sobre"]!!}

                </div>
            </div>
        </div>


        <div class="row" id="faleconosco">
            <div class="col-md-12">
                <h1 class="title">Fale Conosco</h1>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6">
                <form action="{{route("faleconosco.send")}}" method="POST">
                    {!! csrf_field() !!}
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" name="nome" placeholder="Nome" class="form-control" autocomplete="false"
                                   required="required" minlength="2" maxlength="100">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="email" name="email" placeholder="Email" class="form-control"
                                   autocomplete="false"
                                   required="required">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="text" name="assunto" placeholder="Assunto" class="form-control"
                                   autocomplete="false"
                                   required="required" minlength="10" maxlength="100">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <textarea name="mensagem" placeholder="Mensagem" rows="6" class="form-control"
                                      autocomplete="false"
                                      required="required" minlength="20" maxlength="1000"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button class="btn btn-primary veja-mais ">
                                Enviar Mensagem
                                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                {!!$informacoes["maps"]!!}
            </div>

        </div>

        <div class="row text-center">
            <div class="col-md-12 redes-sociais">
                <div class="row">
                    <div class="col-md-4">
                        <a target="_blank" href="{{$informacoes["facebook"]}}" class="rede-social ">
                            <i class="fa fa-facebook-official" aria-hidden="true"></i> / institutogemas
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a target="_blank" href="{{$informacoes["instagram"]}}" class="rede-social ">
                            <i class="fa fa-instagram" aria-hidden="true"></i> / institutogemas
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a target="_blank" href="{{$informacoes["twitter"]}}" class="rede-social ">
                            <i class="fa fa-twitter" aria-hidden="true"></i> @institutogemas
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>




@endsection