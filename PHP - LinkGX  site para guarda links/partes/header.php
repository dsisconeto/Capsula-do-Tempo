<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>LinkGX - Aqui você pode guardar seus links favoritos</title>
    <meta name="description"  content="Bem Vindo ao linkgx.com aqui você pode guardar seus links favoritos, sistema criado para colocar como pagina inicial, mais ninguém vai deixar de usar o Google por isso contamos com buscador em nosso sistema , assim você  pode entrar nos sites que você mais gosta sem precisar ficar lembrando ou ficar digitando todas as vez que for acessar a internet..."/>
    <meta name="keywords"  content="home,page,book,vasp,search,facebook,google,guardar,link,book search,.com,.br,com,,br,net,gx" />
    <link rel="shortcut icon" href="img/icon.png">
    <link href="css/estrutura.css" rel="stylesheet">
    <script  src="js/lib/jquery-1.9.0.min.js"></script>
    <script  src="js/Storage.js"></script>
    <script  src="js/functions.js"></script>
</head>
<body>

<header>
    <div class="clear" id="header">

        <div id="header-logo"> <a href="./index.php">Link <strong>GX</strong></a> </div>
    
        <div id="header-busca">
            <form id="header-busca-caixa" target="_blank" action="https://www.google.com.br/search">
                <input name="q" type="search" placeholder="Pesquisa">
                <button>Buscar</button>
                <div></div>
                <div></div>
                <div class="clear">
                    <span name="google" style="background-image:url('img/google.png');"></span>
                    <span name="youtube" style="background-image:url('img/youtube.png');"></span>
                    <span name="bing" style="background-image:url('img/bing.png');"></span>
                    <span name="yahoo" style="background-image:url('img/yahoo.png');"></span>
                    <span name="facebook" style="background-image:url('img/facebook.png');"></span>
                </div>
                <input name="client" type="hidden" value="linkgx">
            </form>
        </div>

    </div>
</header>
