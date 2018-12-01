<?php 
    include("config/load.php");

    $pName = (isset($_GET['p'])? $_GET['p']: 'desenvolvedor');
?>

<div id="template">
    
    <?php echo $pName; ?>

</div>