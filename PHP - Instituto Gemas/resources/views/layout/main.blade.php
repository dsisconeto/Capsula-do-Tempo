<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! SEO::generate() !!}

    <link rel="stylesheet" href="{{asset(mix('/css/vendor.min.css'))}}">
    <link rel="stylesheet" href="{{asset(mix('/css/site.min.css')) }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/img/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('/img/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/img/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/img/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/img/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/img/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/img/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/img/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/img/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('/img/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/img/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/img/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('/img/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">


    @stack("css")
</head>
<body>
<div class="voltar-topo" id="voltar-topo">
    <i class="fa fa-arrow-up" aria-hidden="true"></i> Subir
</div>
<nav class="navbar navbar-default" id="nav-main">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{env('APP_URL')}}"><img src="{{asset(mix("img/logo.png"))}}"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            <form class="navbar-form navbar-right" action="{{route('pesquisar')}}" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Pesquisar" required minlength="2" name="q">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>
            
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{route("home")}}">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="{{route("home")}}#quemsomos" id="btn-quem-somos">Quem Somos</a></li>
                <li><a href="{{route("eventos")}}">Eventos</a></li>
                <li><a href="{{route("estatuto")}}"
                       alt="Estatuto do Instituto Gemas">Estatuto</a></li>
                <li><a href="{{route("home")}}#faleconosco" id="btn-fale-conosco">Fale Conosco</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<main>
    @yield("container")
</main>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <img src="{{asset(mix('img/logo-white.png'))}}" class="img-responsive center-block">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <h1>Redes Sociais</h1>
                <ul>
                    <li><a target="_blank" href="{{$informacoes["facebook"]}}"><i class="fa fa-facebook-official"
                                                                                  aria-hidden="true"></i> Facebook </a>
                    </li>
                    <li><a target="_blank" href="{{$informacoes["instagram"]}}"><i class="fa fa-instagram"
                                                                                   aria-hidden="true"></i> Instagram</a>
                    </li>
                    <li><a target="_blank" href="{{$informacoes["twitter"]}}"><i class="fa fa-twitter"
                                                                                 aria-hidden="true"></i> Twitter</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-3">
                <h1>Contatos</h1>

                <ul>
                    <li><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$informacoes["email"]}}</li>
                    <li><i class="fa fa-phone" aria-hidden="true"></i> {{$informacoes["telefones"]}}</li>
                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{$informacoes["endereco"]}}</li>

                </ul>
            </div>


        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="footer-copyright">

                    {{$informacoes["rodape"]}}

                    Produced by <a href="https://www.linkedin.com/in/dsisconeto/"> Dejair Sisconeto</a>
                    |
                    Design by <a href="https://www.facebook.com/FernandoFranklinNando">Fernando Franklin</a>

                </div>
            </div>
        </div>
    </div>

</footer>

<script src="{{asset(mix('/js/manifest.js'))}}"></script>
<script src="{{asset(mix('/js/vendor.js'))}}"></script>
@stack("js")
</body>
</html>