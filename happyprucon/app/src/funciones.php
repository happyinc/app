<?
 require_once'../../externo/plugins/PDOModel.php';
// impprime las estrellas segun el promedio
	function print_calificacion($valor)
	{
		$result = "";
		$promedio=number_format($valor,1);
		$result = "<span class='label badge-warning badge'>";
		for ($i = 1; $i <= 5; $i++) 
		{
			if($i < $promedio)
			{
				$result .= "<i class='fa fa-star fa-2x'></i>";
			}
			else
			{
				$temp = $i - $promedio;
				if($temp < 1 && $temp > 0)
				{
					$result .= "<i class='fa fa-star-half-o fa-2x'></i>";
				}
				else
				{
					$result .= "<i class='fa fa-star-o fa-2x'></i>";
				}
			}
		}
		$result .= "</span>";
		return $result;
	}
/// calcula el promedio del emprendedor y pinta las estrellas
	function calificacion($id_usuario)
	{
		$objCal = new PDOModel();
		//consulta para extraer la suma de las filas
		$objCal->where("id_producto", $id_producto);
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
			}
											
		else
			{
				$prom= $sumCal/$cuenta;
				$promedio=number_format($prom,1);
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
		$sumaCalificaciones =  $objCal->select("calificacion_producto");
		foreach ($sumaCalificaciones as $sumaCal)
		{
			foreach ($sumaCal as $sumCal)
			{
				$suma= $sumCal;
			}
		}
        //cosulta para contar el total de filas
		$objCal->where("id_producto", $id_producto);
        $objCal->columns = array("count(*) calificacion");
        $cuentaTotal =  $objCal->select("calificacion_producto");
		foreach ($cuentaTotal as $cuentaTot)
		{
			foreach ($cuentaTot as $cuentaTo)
			{
				$cuenta= $cuentaTo;
			}
		}
		//funcion para calcular el promedio
		if ($sumCal==0 ||$cuenta==0) 
		{
			$prom=0;
		}
		else
		{
			$prom= $sumCal/$cuenta;
			$promedio=number_format($prom,1);
			echo print_calificacion($promedio);
		}
	}

	// traer el nombre del usuario
	//datos del emprendedor
	function nombre_usuario($id_producto)
	{
		$objusu = new PDOModel();
        $objusu->where("id_usuario", $id_emprendedor);
        $objusu->columns = array("nombre");
        $usuario =  $objusu->select("usuario");
        foreach ($usuario as $datos)
		{
			foreach ($datos as $dat)
			{
				$nombre= $dat;
			}
		}

    }




?>