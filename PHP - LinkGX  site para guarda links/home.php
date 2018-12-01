<?php

include("config/load.php");

$erro = null;

// SE EXISTIR SESSION LOCATION PARA INDEX
    if (isset($_SESSION['user']) && $_SESSION["user"] != "") {
        header('location:index.php');
        exit;
    }

// SE EXISTIR COOKIES DE PERMANENCIA LOCATION PARA INDEX
    if (isset($_COOKIE['user']) && $_COOKIE['user'] !="" ) {
        
        $user = new usuario();
        if($user->selecionarPorId($_COOKIE['user']) == true){

            $_SESSION['user'] = $user->getId();
            header('location:index.php');
            exit;

        }

       
    }




if(isset($_POST["login"])){    
$login = new log();
  //FAZENDO LOGIN
    $erro = (!isset($_POST['email'])? 'Digite seu email!': (!isset($_POST['senha'])? 'Digite sua senha!' :null));
    
    $permancia = null;
    if (isset($_POST["conectado"])) {
        $permancia = $_GET["conectado"];
    }


    $login->login($_POST["email"],$_POST["senha"], $permancia);
    
    $login->setEmail($_POST["email"]);
    if ($login->getLogar() == 1) { 
        $erro = "logado";
        header("location:index.php");
        exit();
    }elseif ($login->getLogar() == 3) {
        
        $erro = "Email não cadastrado";
    }elseif ($login->getLogar() == 2) {
         $erro = "Senha incorreta";
        
    }    
}




// FAZENDO LOGOUT
if (isset($_GET["logout"])) {
    $login = new log();
    $login->logout();
}
// CADASTRAR NOVO USUARIO


if(isset($_POST["cadastrar"])){
  $usuario = new usuario();
    
  $cadastrato = $usuario->criar($_POST["nome"], $_POST["email"], $_POST["senha"]);
    if($cadastrato == true){
      
        $login->login($_POST["email"],$_POST["senha"],1);
           if ($login->getLogar() == 1) {
            header("location:index.php");
            exit();
         }     
    }
    
}
?>


<div id="home">
    
    <div id="home-conteudo">

        <div id="home-apresentacao" class="home-painel">
            <span>O que é o LinkGX?</span>

            <span>
                Olá! Seja bem vindo ao linkgx.com! Aqui você pode guardar seus links favoritos. Sistema criado para colocar como pagina inicial, 
                mas ninguém vai deixar de usar o Google por isso contamos com buscador em nosso sistema; 
                Assim você poderá entrar nos sites que você mais gosta sem precisar ficar lembrando ou 
                ficar digitando todas as vezes que for acessar a internet... <a href="informacoes/sobre">Saiba Mais &raquo;</a>
            </span>
        </div>

        <form id="home-login" class="home-painel" action="" method="post" style="position:relative;">
            <h3>Login</h3>

            <div>
                <label> Email </label>
                <input  type="hidden" name="login" value="1">
                <input  type="email" estilo="email" value="<?php if($login){echo $login->getEmail();}?>" name="email" placeholder="Email" required/>

                <label> Senha </label>
                <input type="password" estilo="senha" name="senha" placeholder="Senha" required/>
                
                <label for="conectado"> <input type="checkbox" name="conectado" value="1" checked/> <span>Continuar conectado</span> </label>

                <a href="informacoes/senha">Esqueceu a senha?</a>
                
                <?php if($erro){ echo "<div class=\"home-login_cadastro-msg\"> {$erro} </div>"; } ?>
                
                <button name="logar">Efetuar Login</button>
            </div>
        </form>

        <form id="home-cadastro" class="home-painel" action="" method="post">
            <h3>Cadastro</h3>

            <div>
                <input type="hidden"  name="cadastrar" />
                <label> Nome </label>
                <input type="text" name="nome" placeholder="Nome" required/>

                <label> Email </label>
                <input type="email" name="email" estilo="email" placeholder="Email" required/>

                <label> Senha </label>
                <input type="password" name="senha" estilo="senha" placeholder="Senha" required/>

                <label> Repita a Senha </label>
                <input type="password" name="rSenha" estilo="senha" placeholder="Repita a Senha" required/>

                <button>Cadastrar</button>
            </div>
        </form>

        <iframe id="home-face" src="http://www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FLink-GX%2F490004064396776&amp;width=940&amp;height=300&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=true&amp;appId=108367716016721" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        
        <?php include('partes/rodape.php'); ?>
    </div>
    
</div>
