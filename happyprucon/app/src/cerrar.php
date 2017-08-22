<?
  session_start();
  unset($_SESSION["sesion_activa"]); 
  unset($_SESSION["id_usuario"]);
  unset($_SESSION["id_roles"]); 
  unset($_SESSION["nombre_completo"]);
  unset($_SESSION["nombre"]); 
  unset($_SESSION["apellido"]);
  unset($_SESSION["genero"]); 
  unset($_SESSION["telefono"]);
  unset($_SESSION["suenos"]); 
  unset($_SESSION["origen"]);
  unset($_SESSION["id_roles_alternativo"]);
  session_destroy();
  header("Location: selec_log.html");
  exit;
?>