<?php

class Sessions{
	
	public function __construct(){ }

	//INIT para iniciar las sesiones
	public function init(){
		@session_start();
        $url=$_SERVER['REQUEST_URI'];

        $ruta=explode('/',$url);

        foreach ($ruta as $a=>$b){
            $aplicacion=$b;

        }
        $this->set("url",$url);
        $this->set("aplicacion",$aplicacion);

        /*$objConn = new PDOModel();
        $objConn->where("id", $_SESSION['usu_id']);
        $objConn->delete("ultima_sesion");


        $insertUserData["fecha"] = date("Y-m-d HH:MM:SS");
        $insertUserData["aplicacion"] = $_SESSION['aplicacion'];
        $insertUserData["url"] = $_SESSION['url'];
        $insertUserData["usu_id"] = $_SESSION['usu_id'];
        $insertUserData["rol"] = $_SESSION['id_roles'];
        $insertUserData["fullname"] = $_SESSION['nombre_completo'];
        $insertUserData["name"] = $_SESSION['nombre'];
        $insertUserData["lastname"] = $_SESSION['apellido'];
        $insertUserData["genero"] = $_SESSION['genero'];
        $insertUserData["tel"] = $_SESSION['telefono'];
        $insertUserData["correo"] = $_SESSION['correo'];

        $objConn->insert("ultima_sesion", $insertUserData);*/

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