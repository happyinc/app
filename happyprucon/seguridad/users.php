<?php
require_once'../../conexion/conexion.php';

date_default_timezone_set("America/Bogota");
//date_default_timezone_get();


class Users{

	public $objConn;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
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
			
				//verificación de campos vacios	
				if($username != "" && $password != ""){	
				
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
										
										
										$rol = $res_usu[0]['id_roles'];
										
										echo "<script> alert('Bienvenido!!');</script>";
										
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
											
											echo "<script> window.location.assign('../../app/src/index.php'); </script>";
										}
										else
										{
											echo "<script> window.location.assign('../../app/src/index.php'); </script>";
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
								window.location.assign('../../app/src/logueo.html');</script>";
									}
							}else{
								echo "<script> alert('Usuario inactivo');
								window.location.assign('../../app/src/logueo.html');</script>";
							}		
						}else{
							echo "<script> alert('Por favor contacte al administrador');
							window.location.assign('../../app/src/logueo.html');</script>";
						}
					}else{
						echo "<script> alert('Correo invalido');
						window.location.assign('../../app/src/logueo.html');</script>";		
					}
				}else
					{
						echo "<script> alert('Acceso Denegado');
						window.location.assign('../../app/src/logueo.html');</script>";
					}
			}else{
				echo "<script> alert('Error: no tienes acceso al api');
						window.location.assign('../../app/src/logueo.html');</script>";
			}		
		}
		public function new_user(){

			$objConn = new PDOModel();
			$insertUserData["id_doc"] = $_POST['tipodoc'];
			$insertUserData["id_termino"] = 1;
			$insertUserData["id_estado"] = 1;
			$insertUserData["id_roles"] = 1;
			$insertUserData["nombre_completo"] = $_POST['fullname']." ".$_POST['lastname'];
			$insertUserData["nombre"] = $_POST['fullname'];
			$insertUserData["apellido"] = $_POST['lastname'];
			$insertUserData["genero"] = $_POST['genero'];
			$insertUserData["telefono"] = $_POST['cell'];
			$insertUserData["correo"] = $_POST['username'];
			$insertUserData["password"] = md5($_POST['password']);
			$insertUserData["numero_doc"] = $_POST['cedula'];
			$insertUserData["token"] = 'yositokuqita';
			//$objConn->executeQuery("CALL insert_usu(@in)",$insertUserData);
			$objConn->insert($this->dbTableName, $insertUserData);
			
			if($objConn != ""){
				echo "<script> alert('Registrado correctamente');
						window.location.assign('../../app/src/logueo.html');</script>";
			}else{
				echo "<script> alert('Usuario ya existe');
						window.location.assign('../../app/src/logueo.html');</script>";
			}

		}

        public function update_user(){

            $objConn = new PDOModel();
            $updateUserData["id_doc"] = $_POST['tipodoc'];
            $updateUserData["id_termino"] = 1;
            $updateUserData["id_estado"] = 1;
            $updateUserData["id_roles"] = 1;
            $updateUserData["nombre_completo"] = $_POST['fullname']." ".$_POST['lastname'];
            $updateUserData["nombre"] = $_POST['fullname'];
            $updateUserData["apellido"] = $_POST['lastname'];
            $updateUserData["genero"] = $_POST['genero'];
            $updateUserData["telefono"] = $_POST['cell'];
            $updateUserData["correo"] = $_POST['username'];
            $updateUserData["password"] = $_POST['password'];
            $updateUserData["numero_doc"] = $_POST['cedula'];
            $updateUserData["token"] = 'yositokuqita';
            $objConn->where("id", $_POST['iduser']);
            $objConn->update($this->dbTableName, $updateUserData);

            if($objConn != ""){
                echo "<script> alert('Usuario actualizado correctamente');
                            window.location.assign('../../app/src/logueo.html');</script>";
            }else{
                echo "<script> alert('No se pudo actualizar');
                            window.location.assign('../../app/src/logueo.html');</script>";
            }

        }

        public function delete_user(){

            $objConn = new PDOModel();
            $objConn->where("id", $_POST['iduser']);
            $objConn->delete($this->dbTableName);

            if($objConn != ""){
                echo "<script> alert('Usuario eliminado correctamente');
                                window.location.assign('../../app/src/logueo.html');</script>";
            }else{
                echo "<script> alert('No se pudo eliminar');
                                window.location.assign('../../app/src/logueo.html');</script>";
            }

        }

}

?>