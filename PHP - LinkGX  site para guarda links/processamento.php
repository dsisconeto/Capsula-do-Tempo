<?php

session_start();
include_once 'autoloadOp.php';
include "../include/conexao.php";

    
 if(isset($_POST["list_site"])){
      
        
        $site = $_POST['list_site'];
for ($i = 0; $i < count($site); $i++) {
    mysql_query("UPDATE sites_user SET `ordem`=" . $i . " WHERE `id`='" . $site[$i] . "'") or die(mysql_error());
    }
       
        
    }
     if(isset($_POST["list_categoria"])){
      
      
        $categoria = $_POST['list_categoria'];
        
for ($i = 0; $i < count($categoria); $i++) {

    mysql_query("UPDATE categoria SET `ordem`=" . $i . " WHERE `id`='" . $categoria[$i] . "'") or die(mysql_error());
    }
       
        
    }
    



if ($_POST != null && isset($_POST["op"]) || isset($_POST['usuario']) && $_POST['usuario'] == $_SESSION["user"]) {


    if ($_POST["op"] == "deletarSite") {
        // deletar um site do usuario
        $usuarioId = (int) mysql_real_escape_string(strip_tags(addslashes($_POST['usuario'])));
        $siteId = (int) mysql_real_escape_string(strip_tags(addslashes($_POST['site'])));
        $categoriaId = (int) mysql_real_escape_string(strip_tags(addslashes($_POST['categoria'])));

        $site = new site_usuario($usuarioId, $categoriaId);
        $site->deletarSite($siteId);
    }

    if ($_POST["op"] == "novoSite") {
        // adiciona um novo site

        $usuarioId = $_POST['usuario'];
        $categoriaId = $_POST['categoria'];
        $nome = $_POST['nome'];
        $url = $_POST['url'];
        $status  = $_POST["status"];

        $user = new usuario();
        $user->verificarUsuarioSessionID($usuarioId);
        $categoria = new categoriaUsuario($user->getId());
        $categoria->selectUmaCategoria($categoriaId);
        $site = new site_usuario($user->getId(), $categoria->getId());
        $site->cadastrar($nome, $url,$status);



        include_once '../boxSite.php';
    }

    if ($_POST["op"] == "novaCategoria") {
        // adiciona uma novo categoria 
        $usuarioId = (int) mysql_real_escape_string(strip_tags(addslashes($_POST['usuario'])));



        $categoria = new categoriaUsuario($usuarioId);
        $categoria->cadastrar($_POST['nome'], $_POST["type"]);

        header("location:../index.php?c=" . $categoria->getId());
    }

    if ($_POST["op"] == "UpdateUsuario") {
    /// alterar dados 
        $usuario = new usuario();

        $usuario->verificarUsuarioSessionID($_POST["usuario"]);
        if($usuario->getSenha() == $_POST["Atualsenha"]){
        if($usuario->Update($_POST["usuario"], $_POST["nome"], $_POST["senha"],$_POST["pais"],$_POST["estado"],$_POST["cidade"],$_POST["cep"]) == true){
            header("location:../alterar_dados.php?op=true");
        }
        
        }else{ header("location:../alterar_dados.php?op=false");}
    }

    if ($_POST["op"] == "editar_categoria") {
        /// editar categoria 
        $categoria = new categoriaUsuario($_POST["usuario"]);
        $categoria->selectUmaCategoria($_POST["categoria"]);
        if ($categoria->editar($_POST["nome"], $_POST["type"]) == true) {

            header("location:../index.php?c=" . $_POST["categoria"]);
        }
    }
    if ($_POST["op"] == "destravar_categoria") {
        // destravar a categoria
        $login = new log();
        if ($login->validaUsuario($_POST["usuario"], $_POST["senha"]) == true) {

            $categoria = new categoriaUsuario($_POST["usuario"]);
            if ($categoria->destravar($_POST["categoria"]) == true) {
                echo 'destravada';
            } else {
                echo "tente mais tarde...";
            }
        } else {
            echo "Senha incorreta...";
        }
    }

    
    
} elseif ($_GET != null && isset($_GET["op"]) && $_GET['usuario'] == $_SESSION["user"]) {

    if ($_GET["op"] == "deletarCategoria") {
        // deleta uma  categoria 
        $usuarioId = (int) strip_tags(addslashes($_GET['usuario']));
        $categoriaId = (int) strip_tags(addslashes($_GET['id']));


        $categoria = new categoriaUsuario($usuarioId);
        $categoria->deletar($categoriaId);

        header("location:../index.php");
    }
} else {
    exit();
}
?>
