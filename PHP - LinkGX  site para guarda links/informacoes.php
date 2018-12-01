<?php 
    include("config/load.php");

    $pName = (isset($_GET['p'])? $_GET['p']: 'informacoes');
?>

<div id="template">
    
    <?php echo $pName; ?>

</div>