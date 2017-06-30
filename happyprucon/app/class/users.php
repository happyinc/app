<?php
require_once'../../externo/plugins/PDOModel.php';

date_default_timezone_set("America/Bogota");
//date_default_timezone_get();


class Users{

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
	
		
		public function new_user(){

			$objConn = new PDOModel();
			$insertUserData["id_doc"] = $_POST['tipodoc'];
			$insertUserData["id_termino"] = 1;
			$insertUserData["id_estado"] = 1;
			$insertUserData["id_roles"] = $_POST['roles'];
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
            $updateUserData["id_roles"] = $_POST['roles'];
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