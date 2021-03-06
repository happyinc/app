<?
//Archivo de funciones generales que se utilizaran en la aplicacion
require_once '../../externo/plugins/PDOModel.php';
// impprime las estrellas segun el promedio
function print_calificacion($valor)
{
    $result = "";
    $promedio = number_format($valor, 1);
    $result = "<span>";
    for ($i = 0; $i < 5; $i++) {
        if ($i < $promedio) {
            $result .= "<i class='fa fa-star' style='color:#F9F937'></i>";
        } else {
            $temp = $i - $promedio;
            if ($temp < 1 && $temp > 0) {
                $result .= "<i class='fa fa-star-half-o' style='color:#F9F937'></i>";
            } else {
                $result .= "<i class='fa fa-star-o' sstyle='color:#F9F937'></i>";
            }
        }
    }
    $result .= "</span>";
    return $result;
}

/// calcula el promedio del emprendedor y pinta las estrellas
function calificacion_usuario($id_usuario)
{
    $objCal = new PDOModel();
    //consulta para extraer la suma de las filas
    $objCal->where("id_usuario", $id_usuario);
    $objCal->columns = array("sum(calificacion)");
    $sumaCalificaciones = $objCal->select("calificacion_usuario");
    foreach ($sumaCalificaciones as $sumaCal) {
        foreach ($sumaCal as $sumCal) {
            $suma = $sumCal;
        }
    }

    //cosulta para contar el total de filas
    $objCal->where("id_usuario", $id_usuario);
    $objCal->columns = array("count(*) calificacion");
    $cuentaTotal = $objCal->select("calificacion_usuario");
    foreach ($cuentaTotal as $cuentaTot) {
        foreach ($cuentaTot as $cuentaTo) {
            $cuenta = $cuentaTo;
        }
    }

    //funcion para calcular el promedio
    if ($sumCal == 0 || $cuenta == 0) {
        $prom = 0;
    } else {
        $prom = $sumCal / $cuenta;
        $promedio = number_format($prom, 1);
        echo print_calificacion($promedio);
    }
}

/// calcula el promedio del producto y pinta las estrellas
function calificacion_producto($id_producto)
{
    $objCal = new PDOModel();
    //consulta para extraer la suma de las filas
    $objCal->where("id_producto", $id_producto);
    $objCal->columns = array("sum(calificacion)");
    $sumaCalificaciones = $objCal->select("calificacion_producto");
    foreach ($sumaCalificaciones as $sumaCal) {
        foreach ($sumaCal as $sumCal) {
            $suma = $sumCal;
        }
    }
    //cosulta para contar el total de filas
    $objCal->where("id_producto", $id_producto);
    $objCal->columns = array("count(*) calificacion");
    $cuentaTotal = $objCal->select("calificacion_producto");
    foreach ($cuentaTotal as $cuentaTot) {
        foreach ($cuentaTot as $cuentaTo) {
            $cuenta = $cuentaTo;
        }
    }
    //funcion para calcular el promedio
    if ($sumCal == 0 || $cuenta == 0) {
        $prom = 0;
    } else {
        $prom = $sumCal / $cuenta;
        $promedio = number_format($prom, 1);
        echo print_calificacion($promedio);
    }
}

// funcion que trae el nombre del usuario
function nombre_usuario($id_usuario)
{
    $objusu = new PDOModel();
    $objusu->where("id", $id_usuario);
    $objusu->columns = array("nombre_completo");
    $usuario = $objusu->select("usuarios");
    foreach ($usuario as $datos) {
        foreach ($datos as $dat) {
            $nombre = $dat;
        }

    }
    return $nombre;
}


// funcion que trae la ubicacion del asociado
function ubicacion_usuario($id_usuario)
{
    $ubicacion = "";
    $objusu = new PDOModel();
    $objusu->where("id", $id_usuario);
    $usuario = $objusu->select("usuarios");
    foreach ($usuario as $datos) {
        $ubicacion = $datos["latitud"]."|".$datos["longitud"];
    }
    return $ubicacion;
}


/// calcula el promedio del emprendedor

/// solo trae el valor numerico de la calificacion del emprendedor
	function calificacion_usu($id_usuario)
	{
		$objCal = new PDOModel();
		//consulta para extraer la suma de las filas
		$objCal->where("id_usuario", $id_usuario);
		$objCal->columns = array("sum(calificacion)");
		$sumaCalificaciones =  $objCal->select("calificacion_usuario");
		foreach ($sumaCalificaciones as $sumaCal){
			foreach ($sumaCal as $sumCal){
				$suma= $sumCal;
			}
		}
                                          
		//cosulta para contar el total de filas
		$objCal->where("id_usuario", $id_usuario);
        $objCal->columns = array("count(*) calificacion");
        $cuentaTotal =  $objCal->select("calificacion_usuario");
		foreach ($cuentaTotal as $cuentaTot){
			foreach ($cuentaTot as $cuentaTo){
				$cuenta= $cuentaTo;
			}
		}
											
		//funcion para calcular el promedio
		if ($sumCal==0 ||$cuenta==0) 
			{
				$prom=0;
				$promedio=0;
			}
											
		else
			{
				$prom= $sumCal/$cuenta;
				$promedio=number_format($prom,1);
			}

			return $promedio;
	}

/// calcula el promedio del producto
/// solo trae el valor numerico de la calificacion del producto
function calificacion_prod($id_producto)
{
    $objCal = new PDOModel();
    //consulta para extraer la suma de las filas
    $objCal->where("id_producto", $id_producto);
    $objCal->columns = array("sum(calificacion)");
    $sumaCalificaciones = $objCal->select("calificacion_producto");
    foreach ($sumaCalificaciones as $sumaCal) {
        foreach ($sumaCal as $sumCal) {
            $suma = $sumCal;
        }
    }
    //cosulta para contar el total de filas
    $objCal->where("id_producto", $id_producto);
    $objCal->columns = array("count(*) calificacion");
    $cuentaTotal = $objCal->select("calificacion_producto");
    foreach ($cuentaTotal as $cuentaTot) {
        foreach ($cuentaTot as $cuentaTo) {
            $cuenta = $cuentaTo;
        }
    }
    //funcion para calcular el promedio
    if ($sumCal == 0 || $cuenta == 0) {
        $prom = 0;
        $promedio = 0;
    } else {
        $prom = $sumCal / $cuenta;
        $promedio = number_format($prom, 1);
    }
    return $promedio;
}

//funcion que trae el numero total de cometarios que tiene un producto
function cantidad_coment_prod($id_producto)
{
    $objComent = new PDOModel();
    $objComent->where("id_producto", $id_producto);
    $objComent->columns = array("count(*) comentario");
    $cuentaTotal = $objComent->select("calificacion_producto");
    foreach ($cuentaTotal as $cuentaTot) {
        foreach ($cuentaTot as $cuentaTo) {
            $cuenta = $cuentaTo;
        }
    }
    return $cuenta;
}

function cantidad_coment_usu($id_usuario)
{
    $objComent = new PDOModel();
    $objComent->where("id_usuario", $id_usuario);
    $objComent->columns = array("count(*) comentario");
    $cuentaTotal = $objComent->select("calificacion_usuario");
    foreach ($cuentaTotal as $cuentaTot) {
        foreach ($cuentaTot as $cuentaTo) {
            $cuenta = $cuentaTo;
        }
    }
    return $cuenta;
}


function nombre_producto($id_producto)
{
    $objComent = new PDOModel();
    $objComent->where("id", $id_producto);
    $objComent->columns = array("nombre");
    $cuentaTotal = $objComent->select("producto");
    foreach ($cuentaTotal as $cuentaTot) {

        $cuenta = $cuentaTot["nombre"];
    }
    return $cuenta;
}


function nombre_categoria($id_categoria)
{
    $objComent = new PDOModel();
    $objComent->where("id", $id_categoria);
    $objComent->columns = array("descripcion");
    $cuentaTotal = $objComent->select("categoria");
    foreach ($cuentaTotal as $cuentaTot) {

        $cuenta = $cuentaTot["descripcion"];
    }
    return $cuenta;
}

function nombre_rol($id_rol)
{
    $objComent = new PDOModel();
    $objComent->where("id", $id_rol);
    $objComent->columns = array("descripcion");
    $cuentaTotal = $objComent->select("roles");
    foreach ($cuentaTotal as $cuentaTot) {

        $cuenta = $cuentaTot["descripcion"];
    }
    return $cuenta;
}


?>