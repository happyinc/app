<?php 
error_reporting(E_ALL ^ E_NOTICE);
include 'sessions.php';
include'../../externo/plugins/PDOModel.php';

date_default_timezone_set("America/Bogota");

$objSe = new Sessions();
$objSe->init();
	   
	if($kitse=isset($_SESSION['login_via']['status']))
	{
		if($kitse=='Phone'){ 			
			
			 $cell = $_SESSION['phone']['national_number'];	
			 
				$objConn = new PDOModel(); 
				$objConn->columns = array("count(*)");
				$objConn->where("telefono",$cell);
				$result =  $objConn->select("usuarios");
					
					if($result[0]['count(*)'] == 1){
						$objConn = new PDOModel(); 
						$objConn->where("telefono",$cell);
						$res_usu =  $objConn->select("usuarios");

						$rol = $res_usu[0]['id_roles'];
						$id_usu = $res_usu[0]['id'];		
						
						$updateUser["ultimo_acceso"] = date("Y-m-d H:i:s");
						$objConn->where("id", $res_usu[0]['id']);
						$objConn->update("usuarios", $updateUser);
						
						if($rol == 2)
										{
											$objConn = new PDOModel();
											$insertSe["id_usuario"] = $id_usu;
											$insertSe["origen"] = "W";
											$insertSe["f_login"] = date("Y-m-d H:i:s");
											$insertSe["estado"] = "A";
											$insertSe["ip"] = $_SERVER['REMOTE_ADDR'];
											$objConn->insert("sesion", $insertSe);
											$ultima_sesion = $objConn->lastInsertId;

                                            $objSe->init();
                                            $objSe->set('id_usuario', $res_usu[0]['id']);
                                            $objSe->set('id_roles', $res_usu[0]['id_roles']);
                                            $objSe->set('nombre_completo', $res_usu[0]['nombre_completo']);
                                            $objSe->set('nombre', $res_usu[0]['nombre']);
                                            $objSe->set('apellido', $res_usu[0]['apellido']);
                                            $objSe->set('genero', $res_usu[0]['genero']);
                                            $objSe->set('telefono', $res_usu[0]['telefono']);
                                            $objSe->set('correo', $res_usu[0]['correo']);
											
											echo "<script> window.location.assign('../../app/src/index.php'); </script>";
										}
										else
										{
											echo "<script> window.location.assign('../../app/src/index.php'); </script>";
										}
						
					}else{
						echo "<script> alert('Telefono no se encuentra registrado');
							window.location.assign('../../app/src/sel_rol.php');</script>";
							
							$cell = $_SESSION['phone']['national_number'];
					}
		}
		else if($kitse =='Email')
		{
			$correo = $_SESSION['email']['address'];		
			
				$objConn = new PDOModel(); 
				$objConn->columns = array("count(*)");
				$objConn->where("correo",$correo);
				$result =  $objConn->select("usuarios");
					
					if($result[0]['count(*)'] == 1){
						$objConn = new PDOModel(); 
						$objConn->where("correo",$correo);
						$res_usu =  $objConn->select("usuarios");

						$rol = $res_usu[0]['id_roles'];
						$id_usu = $res_usu[0]['id'];		
						
						$updateUser["ultimo_acceso"] = date("Y-m-d H:i:s");
						$objConn->where("id", $res_usu[0]['id']);
						$objConn->update("usuarios", $updateUser);
						
						if($rol == 2)
										{
											$objConn = new PDOModel();
											$insertSe["id_usuario"] = $id_usu;
											$insertSe["origen"] = "W";
											$insertSe["f_login"] = date("Y-m-d H:i:s");
											$insertSe["estado"] = "A";
											$insertSe["ip"] = $_SERVER['REMOTE_ADDR'];
											$objConn->insert("sesion", $insertSe);
											$ultima_sesion = $objConn->lastInsertId;

                                            $objSe->init();
                                            $objSe->set('id_usuario', $res_usu[0]['id']);
                                            $objSe->set('id_roles', $res_usu[0]['id_roles']);
                                            $objSe->set('nombre_completo', $res_usu[0]['nombre_completo']);
                                            $objSe->set('nombre', $res_usu[0]['nombre']);
                                            $objSe->set('apellido', $res_usu[0]['apellido']);
                                            $objSe->set('genero', $res_usu[0]['genero']);
                                            $objSe->set('telefono', $res_usu[0]['telefono']);
                                            $objSe->set('correo', $res_usu[0]['correo']);
											
											echo "<script> window.location.assign('../../app/src/index.php'); </script>";
										}
										else
										{
											echo "<script> window.location.assign('../../app/src/index.php'); </script>";
										}
						
					}else{
						echo "<script> alert('Email no se encuentra registrado');
							window.location.assign('../../app/src/sel_rol.php');</script>";
							
							$correo = $_SESSION['email']['address'];
					}
		}
	}

	
	
?>