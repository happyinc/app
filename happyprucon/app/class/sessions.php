<?php

class Sessions{
	
	public function __construct(){ }

    //Care pito

	//INIT para iniciar las sesiones
	public function init(){
		@session_start();
	}

	//SET nos permite inicializar las variables de Session a utilizar
	public function set($varname, $value){
		
		$_SESSION[$varname] = $value;
		
	}
	
	public function destroy(){
		
		session_unset();
		session_destroy();
		
	}
	
}

?>