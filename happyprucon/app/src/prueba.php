<?php
    require_once'../../../externo/plugins/PDOModel.php';
    
    
    //obtener usuarios de busqueda
    $searchTerm = $_POST['comp'];
    
    //obtener datos coincidentes de la tablas usuario
   /* $query = $mysqli->query("SELECT * FROM usuario WHERE nom_completo LIKE '%".$searchTerm."%' ORDER BY nom_completo ASC");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['nom_completo'];
    }*/
    
    //devolver datos 
    echo json_encode($data);
	
	$objCat = new PDOModel();
	$objCat->andOrOperator = "AND";
	$objCat->where("nombre", $searchTerm);
	$objCat->where("id_estado", 1);
	$objCat->orderByCols = array("nombre");
	$result =  $objCat->select("composicion");
	
?>