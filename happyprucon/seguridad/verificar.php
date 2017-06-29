<?php
require_once'../../externo/plugins/PDOModel.php';

date_default_timezone_set("America/Bogota");
//date_default_timezone_get();


class Verificar{

	public $objConn;
	public $objSe;
	public $result;
	public $dbTableName;
	public $username;
	public $password;

	public function __construct(){

			$this->objSe = new Sessions();
			$this->dbTableName = 'usuarios';
			
		}

	public function login_in(){
				
				$app = $_POST['txtkey'];
				$apk = md5($app);

				$mydate = getdate(date("U"));
					  
					  $day = "";
						$lon = strlen($mydate["mday"]);
						if ($lon == 1) {
							$day = "0" . $mydate["mday"];
						} else {
							$day = $mydate["mday"];
						}

						$key = "H*2017*" . $day;
						$api_key = md5($key);
			
				$username = $_POST['usern'];
				$password = $_POST['passwd'];	
				
				if($apk == $api_key){
				
					if(isset($_POST['formulario']) && $_POST['formulario'] == "w")
					{
					
						//verificación de campos vacios	
						if( isset($_POST['usern']) && $_POST['usern'] != "" && isset($_POST['passwd']) && $_POST['passwd'] != "")
						{	
						
							$objConn = new PDOModel(); 
							$objConn->columns = array("count(*)");
							$objConn->where("correo",$username);
							$result =  $objConn->select($this->dbTableName);
							
							if($result[0]['count(*)'] == 1){
								
								$objConn = new PDOModel(); 
								$objConn->where("correo",$username);
								$res_usu =  $objConn->select($this->dbTableName);
								
								if($res_usu[0]["acceso_fallido"] <= 3){	
									
									//verificación de estado de usuario
									if($res_usu[0]["id_estado"]==1){
										
										$contra = md5($password);
										$id_usu = $res_usu[0]['id'];
										//comparación de contraseñas
										if($contra == $res_usu[0]['password']){
											
											$objConn = new PDOModel(); 
											$updateUser["ultimo_acceso"] = date("Y-m-d H:i:s");
											$objConn->where("id", $res_usu[0]['id']);
											$objConn->update($this->dbTableName, $updateUser);		
												
												$this->objSe->init();
												$this->objSe->set('id', $res_usu[0]['id']);
												$this->objSe->set('correo', $res_usu[0]['correo']);
												$this->objSe->set('id_roles', $res_usu[0]['id_roles']);
												
												$fullname = $res_usu[0]['nombre_completo'];
												$rol = $res_usu[0]['id_roles'];
												
												//Verificación de roles
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
													
													$this->objSe->init();
													$this->objSe->set('id',$ultima_sesion);
													
													echo "<script> window.location.assign('../../app/src/admin_2_material_design/index.php'); </script>";
												}
												else
												{
													echo "<script> window.location.assign('../../app/src/admin_2_material_design/index.php'); </script>";
												}
										}else{
											$fallo = $res_usu[0]["acceso_fallido"]+1;
											$objConn = new PDOModel(); 
											$updateUser["acceso_fallido"] = $fallo;
											$objConn->where("id", $res_usu[0]['id']);
											$objConn->update($this->dbTableName, $updateUser);
											
											$insertSe["id_usuario"] = $id_usu;
											$insertSe["origen"] = "W";
											$insertSe["f_login"] = date("Y-m-d H:i:s");
											$insertSe["f_logout"] = date("Y-m-d H:i:s");
											$insertSe["estado"] = "X";
											$insertSe["ip"] = $_SERVER['REMOTE_ADDR'];
											$objConn->insert("sesion", $insertSe);	
											echo "<script> alert('La contraseña no es valida, intentos fallidos # $fallo');
										window.location.assign('../../app/src/admin_2_material_design/logueo.html');</script>";
											}
									}else{
										echo "<script> alert('Usuario inactivo');
										window.location.assign('../../app/src/admin_2_material_design/logueo.html');</script>";
									}		
								}else{
									echo "<script> alert('Por favor contacte al administrador');
									window.location.assign('../../app/src/admin_2_material_design/logueo.html');</script>";
								}
							}else{
								echo "<script> alert('Correo invalido');
								window.location.assign('../../app/src/admin_2_material_design/logueo.html');</script>";		
							}
						}
						else if( isset($_POST['usern']) && $_POST['usern'] == "" || isset($_POST['passwd']) && $_POST['passwd'] == "")
							{
								echo "<script> alert('Faltan campos por diligenciar');
								window.location.assign('../../app/src/admin_2_material_design/logueo.html');</script>";
							}
						
					}	
					else if(isset($_POST['formulario']) && $_POST['formulario'] == "f")
					{
						if( isset($_POST['email']) && $_POST['email'] != "")
						{

						}
						else
						{
							////// NO HAY CORREO DESDE FACEBOOK

						}
					}	
						
						
				}else
				{
					echo "<script> alert('Error: no tienes acceso al api');
							window.location.assign('../../app/src/admin_2_material_design/logueo.html');</script>";
				}		
			}
		
}	
?>		