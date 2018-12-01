<?php
function __autoload($class){
    
    if(file_exists("class/".$class.".php")){
      include_once ('class/'.$class.".php");
   
    }else{
        echo "A classe ".$class." não existe";
    }
    
}

?>
