<?php

function fInclude($file){

	for($x=0; $x<4; $x++){
		$y = (str_repeat("../",$x));
		$file = "${y}${file}";
		
		(file_exists($file)? ($x=4): null);
		(file_exists($file)? (include_once($file)): null);
	}
}

fInclude("config/conexao.php");

fInclude("partes/header.php");
