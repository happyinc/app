<?php
date_default_timezone_set("America/Bogota");
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



        if(isset($_SESSION['id_usuario']) && $_SESSION['id_usuario'] != "")
        {
            $objConn = new PDOModel();
            $objConn->where("id_usuario", $_SESSION['id_usuario']);
            $objConn->delete("ultima_sesion");


            $insertUserData["fecha"] = date("Y-m-d H:i:s");
            $insertUserData["aplicacion"] = $_SESSION['aplicacion'];
            $insertUserData["url"] = $_SESSION['url'];
            $insertUserData["id_usuario"] = $_SESSION['id_usuario'];
            $insertUserData["rol"] = $_SESSION['id_roles'];
            $insertUserData["fullname"] = $_SESSION['nombre_completo'];
            $insertUserData["name"] = $_SESSION['nombre'];
            $insertUserData["lastname"] = $_SESSION['apellido'];
            $insertUserData["genero"] = $_SESSION['genero'];
            $insertUserData["correo"] = $_SESSION['correo'];
            $objConn->insert("ultima_sesion", $insertUserData);
        }

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