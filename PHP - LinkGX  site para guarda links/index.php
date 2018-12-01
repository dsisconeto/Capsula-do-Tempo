<?php
/*
session_start();

if(!isset($_SESSION["user"]) || $_SESSION["user"] == null){
      //  header("location:home.php?logout");
        exit();
}

include("config/load.php");

$user = new usuario();
$user->selecionarPorId($_SESSION["user"]);
$categoria = new categoriaUsuario($user->getId());

    if(isset($_GET['site'])||isset($_POST['siteAdc'])){
    //	include('completar/novosite.php');
    //	exit();
    }

    if(isset($_POST["c"]) && $_POST["c"] != null){
      //  unset($_SESSION["categoria"]);

       // $_SESSION["categoria"] = $_POST["c"];

    }




    if($user->getStatus() == 1 || $user->getStatus() == null || $user->getStatus() == 0){

        Completar::get('perfil');

    }
    elseif($user->getStatus() == 2){
       // Completar::get('sites');
         //Completar::get('novosite');
    }

  */

?>

<style>
.clear:after {
    content: ".";
    height: 0;
    clear: both;
    display: block;
    visibility: hidden;
    overflow: hidden;
}

#template {
    min-height: 110%;
    position: relative;
}

#template-conteudo-lateral {
    position: fixed;
    top: 60px;
    width: 240px;
    height: 100%;
    
    border: solid #CCC;
    border-width: 0 1px;
    background: #FFF;
    z-index: 1;
}

#template-conteudo-lateral input {
    width: 70%;
    float: left;
    border-radius: 0;
    box-shadow: none;
    border-width: 0 0 1px 0;
}

#template-conteudo-lateral button {
    width: 30%;
    float: left;
    border-radius: 0;
    box-shadow: none;
    border-width: 0 0 1px 1px;
    margin: 0;
    background: #DDD;
}

#template-conteudo-lateral-lista {
    height: 100%;
    overflow: auto;
}

#template-conteudo-lateral-lista a {
    display: block;
    width: 100%;
    height: 30px;
    line-height: 30px;
    border-bottom: 1px solid #DDD;
    padding: 0 10px;
    font-size: 13px;
    color: #999;
    text-transform: capitalize;
}

#template-conteudo-lateral-lista a:hover, #template-conteudo-lateral-lista a.selecionado {
    color: #3b5999;
}

#template-conteudo-central {
    float: right;
    width: 680px;
    margin-bottom: 0;
}

#template-conteudo-central-sites {
    width: 680px;
}

.template-conteudo-central-sites {
    width: 210px;
    height: 100px;
    float: left;
    margin: 0 15px 15px 0;

    border: 1px solid #CCC;
    background: #EEE;
    border-radius: 5px;
}

.template-conteudo-central-sites div {
    height: 70px;
    background-image: url(img/www.png);
    background-repeat: no-repeat;
    background-position: center; 
}

.template-conteudo-central-sites div img {
    display: none;
}

.template-conteudo-central-sites span {
    display: block;
    height: 28px;
    line-height: 28px;
    text-align: center;
    font-size: 13px;
    border-top: 1px solid rgba(0,0,0, .1);
    border-radius: 0 0 5px 5px;
    background: #3d3d3d;
    color: #999;
    font-size: 12px;
    text-transform: capitalize;
}

.template-conteudo-central-sites:hover span {
    color: #FFF;
}
</style>

<script src="js/lib/jquery-ui.min.js"></script>

<script>
$(function(){

    _GET = {};
    document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
        function decode(s) {
            return decodeURIComponent(s.split("+").join(" "));
        }
        _GET[decode(arguments[1])] = decode(arguments[2]);
    });

    $('a[href="?cat='+(_GET['cat']||'principal')+'"]').addClass('selecionado');

    function alteraORdem() {
        var itens = $('#template-conteudo-central-sites').sortable("toArray");

        if($.Storage.loadItem('listaSites')) {
            var lista = $.Storage.loadItem('listaSites');
            for(i in lista) {  (itens.indexOf(lista[i])>=0? null: itens.push(lista[i])); }
        }

        $.Storage.saveItem('listaSites', itens);
    }

    function ordenaSites() {
        var list = $('#template-conteudo-central-sites');
        if (list == null) return
     
        var storage = $.Storage.loadItem('listaSites');
        if (!storage) return;

        var items = list.sortable("toArray");
     
        var rebuild = new Array();
        for(var v=0, len=items.length; v<len; v++){
            rebuild[items[v]] = items[v];
        }
     
        for(var i=0, n=storage.length; i<n; i++) {
            var itemID = storage[i];

            if (itemID in rebuild) {
                var item = rebuild[itemID];
                var child = novoId = $("#"+itemID);
                child.parent().append(novoId);
            }
        }
    }
 
    $('#template-conteudo-central-sites').sortable({
        cursor: "move",
        update: function(){ alteraORdem(); }
    });

    ordenaSites();


   
    var c = "<?php  $categoria->getPrimeiraCategoria(); echo $categoria->getId(); ?>"; 
       
    $.ajax({
     
         url:"sitesBox.php",
         type:"post",
         data:{c:c},
         dataType:"html",
         success:function(e){
             $("#template-conteudo-central-sites").html(e);
         },
          error:function(e){
            
             alert("erro");
         }
    });    

});

    function categoria(c){
        var c;
        
     $.ajax({
         url:"sitesBox.php",
         type:"POST",
         data:{
             c:c
           },
         dataType:"html",
         success:function(e){
             $("#template-conteudo-central-sites").html(e);
             
             
         }
        
         
         
         
         
     });
    }
</script>

<div id="template" class="clear">
    
    <div id="template-conteudo" class="clear">
        
        <div id="template-conteudo-lateral" class="clear">
            
            <form action="" method="post" id="template-conteudo-lateral-novo" class="clear">
                <input type="search" placeholder="Nome da categoria" name="categoria" list="categorias">

                <datalist>

                    <option value="Redes Sociais">
                    <option value="Arquivos">
                    <option value="Tutoriais">
                    <option value="Downloads">
                    <option value="Notícias">
                    <option value="Tutoriais">
                    <option value="Importantes">
                    <option value="Meus Sites">
               
           
                </datalist>

                <button>Adc</button>
            </form>
            
            <div id="template-conteudo-lateral-lista">
            <?php 
               $dados =  $categoria->selecionarTodas();
                foreach ($dados as $k){
            ?>
                <a style="cursor: pointer" href="#" onclick="categoria(<?= $k["id"] ?>);" > <?=  $k["nome"]?> </a>
                
            <?php }?>
     
            </div>
            
        </div>
		
        <div id="template-conteudo-central">
            
            <div id="template-conteudo-central-sites" class="clear">
                
                <!-- Aqui vc coloca o while -->
                <!-- O id de cada item vc troca pelo id do site mesmo... aqui só coloquei "$categoria'-site' " pra teste -->
                 
                
                
            </div>
            
          <?php //include('partes/rodape.php'); ?> 
        </div>

    </div>
    
</div>