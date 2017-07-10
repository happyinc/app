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
			$insertUserData["id_termino"] = $_POST['acep-terms'];
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
            $insertUserData["direccion"] = $_POST['direccion'];
            $insertUserData["latitud"] = $_POST['latitud'];
            $insertUserData["longitud"] = $_POST['longitu'];
			$insertUserData["token"] = 'yositokuqita';
			//$objConn->executeQuery("CALL insert_usu(@in)",$insertUserData);
			$objConn->insert($this->dbTableName, $insertUserData);

            $id_usuario= $objConn->lastInsertId;
			if($id_usuario != ""){

                if($_FILES['foto']["size"]>=1){
                    // Primero, hay que validar que se trata de un JPG/GIF/PNG
                    $allowedExts = array("jpg", "jpeg", "gif", "png", "bmp", "JPG", "JPEG", "GIF", "PNG", "BMP");
                    $extension = end(explode(".", $_FILES["foto"]["name"]));
                    if ((($_FILES["foto"]["type"] == "image/gif")
                            || ($_FILES["foto"]["type"] == "image/jpeg")
                            || ($_FILES["foto"]["type"] == "image/png")
                            || ($_FILES["foto"]["type"] == "image/gif")
                            || ($_FILES["foto"]["type"] == "image/bmp"))
                        && in_array($extension, $allowedExts))
                    {
                        // el archivo es un JPG/GIF/PNG, entonces...

                        $extension = end(explode('.', $_FILES['foto']['name']));
                        $foto = substr(md5(uniqid(rand())),0,10).".".$extension;
                        $directorio = "usuarios/perfiles/".$id_usuario.""; // directorio de tu elección
                        if(file_exists($directorio))
                        {

                        }
                        else
                        {
                            mkdir($directorio, 0777, true);
                        }

                        // almacenar imagen en el servidor
                        move_uploaded_file($_FILES['foto']['tmp_name'], $directorio.'/'.$foto);
                        $minFoto = 'min_'.$foto;
                        $resFoto = 'res_'.$foto;
                        resizeImagen($directorio.'/', $foto, 65, 65,$minFoto,$extension);
                        resizeImagen($directorio.'/', $foto, 500, 500,$resFoto,$extension);
                        unlink($directorio.'/'.$foto);

                    } else { // El archivo no es JPG/GIF/PNG
                        $malformato = $_FILES["foto"]["type"];
                        ?>
                        <script type="text/javascript">alert("La imagen se encuentra con formato incorrecto")</script>
                        <?
                        //header("Location: crear_producto.php?id=echo $usu_id");
                    }

                } else { // El campo foto NO contiene una imagen

                    ?>
                    <script type="text/javascript">
                        alert("No se ha seleccionado imagenes");
                        window.history.back();
                    </script>
                    <?
                }

				echo "<script> alert('Registrado correctamente');
						window.location.assign('../../app/src/logueo.html');</script>";
			}else{
				echo "<script> alert('Usuario ya existe');
						window.location.assign('../../app/src/logueo.html');</script>";
			}

		}



        public function update_user(){

            $objConn = new PDOModel();
            $updateUserData["nombre_completo"] = $_POST['fullname']." ".$_POST['lastname'];
            $updateUserData["nombre"] = $_POST['fullname'];
            $updateUserData["apellido"] = $_POST['lastname'];
            $updateUserData["genero"] = $_POST['genero'];
            $updateUserData["telefono"] = $_POST['cell'];
            $updateUserData["correo"] = $_POST['username'];
            $objConn->where("id", $_POST['iduser']);
            $objConn->update($this->dbTableName, $updateUserData);

            if($objConn != ""){
                $objConn = new PDOModel();
                $objConn->where("id",$_POST['iduser']);
                $res_usu =  $objConn->select("usuarios");

                $this->objSe->init();
                $this->objSe->set('id', $res_usu[0]['id']);
                $this->objSe->set('id_roles', $res_usu[0]['id_roles']);
                $this->objSe->set('nombre_completo', $res_usu[0]['nombre_completo']);
                $this->objSe->set('nombre', $res_usu[0]['nombre']);
                $this->objSe->set('apellido', $res_usu[0]['apellido']);
                $this->objSe->set('genero', $res_usu[0]['genero']);
                $this->objSe->set('telefono', $res_usu[0]['telefono']);
                $this->objSe->set('correo', $res_usu[0]['correo']);

                echo "<script> alert('Usuario actualizado correctamente');
                        window.location.assign('../../app/src/perfil.php');</script>";
            }else{
                echo "<script> alert('No se pudo actualizar');</script>";
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