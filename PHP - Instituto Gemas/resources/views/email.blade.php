<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: #314a29;
            color: #fff;

        }

        header {
            width: 100%;
            padding: 20px 0;
            margin-bottom: 20px;
            background: #fff;
        }

        header img {
            display: block;
            max-width: 100%;
            margin: 0 auto;
        }

        main {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        main h2 {
            font-size: 30px;
            text-align: center;
        }

        main h2 small {
            font-size: 15px;
        }

        main p {
            text-align: justify;
        }

        footer {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }

    </style>

</head>

<body>
<header>
    <img src="{{asset("/img/logo.png")}}">
</header>


<main>
    <h2>ENVIADO POR<br>
        <small>
            {{$data["nome"]}} <{{$data["email"]}}>
        </small>
    </h2>
    <h2>ASSUNTO<br>
        <small>{{$data["assunto"]}}</small>
    </h2>

    <h2>MENSAGEM:</h2>
    <p>
        {{$data["mensagem"]}}
    </p>
</main>


<footer>
    Email enviado pelo formulario de Fale Conosco do Site Instituto Gemas.
</footer>

</body>
</html>