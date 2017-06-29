
<?php
//Include database configuration file
require_once'../../externo/plugins/PDOModel.php';


if(isset($_POST["id"]) && !empty($_POST["id"])){
 
	$categoria=$_POST["id"];
	
    //Se obtienen todas las categorias asociadas al id dl bien enviado por post
    $objCat = new PDOModel();
	$objCat->andOrOperator = "AND";
	$objCat->where("id_bienes", $categoria);
	$objCat->where("id_estado", 1);
	$objCat->orderByCols = array("descripcion");
	$result =  $objCat->select("categoria");
	
	$objCat->totalRows;
    //Despliega todas las categorias
	if($objCat > 0){
        echo '<option value="">Seleccione la subcategoria</option>';
        foreach($result as $item){ 
            echo '<option value="'.$item['id'].'">'.$row['descripcion'].'</option>';
        }
    }else{
        echo '<option value="">Subcategorias no disponibles</option>';
    }
	
}

	
?>