<?php
    require_once'../../externo/plugins/PDOModel.php';
    
	?> <script type="text/javascript">alert("llego la composicion a completar: <?php echo  $_POST['comp']?> ")</script><?php
    
    //obtener usuarios de busqueda
    $searchTerm = $_POST['comp'];
    
    //obtener datos coincidentes de la tablas usuario
	$objCat = new PDOModel();
	$objCat->where("nombre", $searchTerm);
	$result =  $objCat->select("composicion");
	$result->totalRows;
	if($result > 0){
		foreach($result as $item){
				echo $item["nombre"];
// hacer el insert a la tabla de composicion_producto
				$pdomodel->insert("order", array("orderNumber"=>1001, "customerName"=>"John Cena", "address"=>"140 B South Jercy");
				//$objCat->insert("composicion_producto", array("id_composicion"=>$item["id"], "id_producto"=>"John Cena");
		}
	}
	else {
		$objCat->insert("composicion", array("id_estado"=>1, "id_bienes"=>"John Cena","id_usuario"=>$_SESSION["id_usuario"],"nombre"=>$searchTerm,"fecha"=>date("Y-m-d H:i:s"));
		//$objCat->insert("composicion_producto", array("id_composicion"=>$item["id"], "id_producto"=>"John Cena");
	}
																
														
												
	
	
	
    //devolver datos 
    echo json_encode($data);
?>