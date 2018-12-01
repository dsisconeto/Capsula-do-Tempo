<?php 
$p = $_POST;
include("autoload.php");
session_start();
$user = new usuario();
$user->selecionarPorId(1);
$categoria = new categoriaUsuario($user->getId());

if(isset($p["c"]) && $p["c"]!= null){
    
    $categoria->selecionarUma($p["c"]); 
    $site = new siteUsuario($user->getId(), $categoria->getId());
}else{
    
    $categoria->getPrimeiraCategoria();
     $site = new siteUsuario($user->getId(), $categoria->getId());
}


?>                

<?php 
    $dados = $site->selecioneTodosSites();
    
    foreach ($dados as $k){
            
      if($k["type"] == 3){
          $referencia = $site->selecionarReferencia($k["referencia"]);
          foreach ($referencia as $r){

?>

<a class="template-conteudo-central-sites ui-state-default" title="<?= $r["nome"]?>" id="-facebook" href="<?= $r["url"] ?>" target="_blank">
                    <div title="<?= $r["nome"]?>" style="background-image:url('img/sites/<?= $r["img"]?>');"></div>
                    <span title="<?= $r["nome"]?>"> <?= $r["nome"]?></span>
                </a>
  <?php   }}else{ ?>
        
       <a class="template-conteudo-central-sites ui-state-default" title="<?= $k["nome"]?>" id="-facebook" href="<?= $k["url"] ?>" target="_blank">
           <div title="<?= $k["nome"]?>"></div>
                    <span title="<?= $k["nome"]?>"> <?= substr($k["nome"],0,25)?></span>
                </a> 
     <?php }}?>
