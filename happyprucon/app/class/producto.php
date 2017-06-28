<?php
require_once'../../externo/plugins/PDOModel.php';

date_default_timezone_set("America/Bogota");
//date_default_timezone_get();


class Poductos{

	public $objConn;
	public $result;
	public $dbTableName;
		
	public function __construct(){

      $this->dbTableName = 'producto';
		
	}
	
		
		public function new_producto(){
			
			$objConn = new PDOModel();
			$insertproduData["categoria"] = 1;//$_POST["categoria"];
			$insertproduData["nombre"] = "arroz con pollo";//$_POST["nombre"]; 
			$insertproduData["descripcion"] = "arroz con pollo";//$_POST["descripcion"];
			$insertproduData["precio"] = 12333;//$_POST["precio"];
			//$insertEmpData["foto"] = $_POST["foto"];
			$insertproduData["fecha"] = date("Y-m-d H:i:s"); 
			$insertproduData["id_estado"] = 1; 
			$objConn->insert($this->dbTableName, $insertproduData);
			
			
			if($objConn != ""){
				echo "<script> alert('Registrado correctamente');
						window.location.assign('../../app/src/admin_2_material_design/crear_producto.php');</script>";
			}else{
				echo "<script> alert('Producto ya existe');
						window.location.assign('../../app/src/admin_2_material_design/crear_producto.php');</script>";
			}

		}

      /*  public function update_producto(){

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
                            window.location.assign('../../app/src/admin_2_material_design/logueo.html');</script>";
            }else{
                echo "<script> alert('No se pudo actualizar');
                            window.location.assign('../../app/src/admin_2_material_design/logueo.html');</script>";
            }

        }

        public function delete_producto(){

            $objConn = new PDOModel();
            $objConn->where("id", $_POST['iduser']);
            $objConn->delete($this->dbTableName);

            if($objConn != ""){
                echo "<script> alert('Usuario eliminado correctamente');
                                window.location.assign('../../app/src/admin_2_material_design/logueo.html');</script>";
            }else{
                echo "<script> alert('No se pudo eliminar');
                                window.location.assign('../../app/src/admin_2_material_design/logueo.html');</script>";
            }

        }*/

}

?>