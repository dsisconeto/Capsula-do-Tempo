<?php
	
	class Completar {

		public static function get($str){
			
			if(!isset($usuario->$str)){

				if(is_array($str)){

					foreach($str as $file) {
						include("completar/{$file}.php");
						exit();
					}
				} else {
					
					include("completar/{$str}.php");
					exit();
				}
			}
		}

	}

?>