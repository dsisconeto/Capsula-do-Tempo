<?php
	function fInclude($file){ include(file_exists("{$file}")? "{$file}": (file_exists("../{$file}")? "../{$file}": (file_exists("../../{$file}")? "../../{$file}": "../../../{$file}")) ); }

	include("config/conexao.php");

	if(itsme() && isset($_POST)){

		extract($_POST);

		switch($type){

			case 'edit':
					
					switch($action){

						case 'vLogin':
							// Conectar a DB aqui, e retornar true ou false para $existe
							// se o usuario existir retorna true, caso contrario false
							// depois da consulta pode apagar as duas linhas abaixo e
							// retornar somento o valor de $existe;
							$user = array('teedmaker', 'tadeubarbosa');
							$existe = in_array($login,$user);

							$result = (strlen($login)<6? 'No mínimo 5 caracteres!': ($existe?'Este login já existe!': 'ok'));

							echo json_encode(array('result'=>$result, 'login'=>$login));
							break;
						#
					}

				break;
			#
			case 'login': 
				
				break;
			#
		}
	}
?>