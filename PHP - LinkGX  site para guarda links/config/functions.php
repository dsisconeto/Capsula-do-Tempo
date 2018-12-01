<?php

ob_start();
session_start();

function escape( $var ){ return Banco::$conn->real_escape_string($var); }

 


function tratar( $url ) {
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
    return $url;
}

function itsme(){
	$ref = explode('/', str_replace(array('http://','https://'),'',$_SERVER['HTTP_REFERER']));
	return ($ref[0]==$_SERVER['HTTP_HOST']? true: false);
}