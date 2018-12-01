<?php

switch ($_SERVER['SERVER_NAME']) {
    case 'localhost':
        define("HOST_NAME","localhost");
        define("HOST_USER","root");
        define("HOST_PASS","teed");
		define('HOST_DB', 'linkgx');
    break;
    
    default:
        # default values;
    break;
}

$site = (object) array();
$site->servidor = 'http://'.$_SERVER['HTTP_HOST'];
$site->base = $site->servidor . $_SERVER['PHP_SELF'];
$site->arquivo = end(explode('/', $site->base ) );
$site->pasta = str_ireplace( $site->arquivo ,'', $site->base );
$site->remoto = $site->servidor . $_SERVER['PHP_SELF'];

?>