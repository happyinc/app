<?php
error_reporting(0);
require_once'../../externo/plugins/PDOModel.php';
include '../class/sessions.php';

$objSe = new Sessions();
$objSe->init();

$usu_id = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null ;

$archivos = "";
$directorio = "usuarios/$usu_id/sitio/";
if (file_exists($directorio))
{
    $direct=opendir($directorio);
    while ($archivo = readdir($direct))
    {
        if($archivo=='.' or $archivo=='..')
        {

        }
        else
        {
            $rut = $directorio."/".$archivo;
            $archivos .= "'<img height='120px' src=".$rut." class='file-preview-image'>',";
        }
    }
    closedir($directorio);
}

if (file_exists($directorio)) {

} else {
    mkdir($directorio, 0777, true);
}

$Imagenes = count($_FILES['fotos']['name']);

for($i = 0; $i < $Imagenes; $i++ ){

    $nombreArchivo=$_FILES['fotos']['name'][$i];
    $nombreTemporal=$_FILES['fotos']['tmp_name'][$i];

    $rutaArchivo=$directorio.$nombreArchivo;

    move_uploaded_file($nombreTemporal,$rutaArchivo);

    $infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"120px","url"=>"borrar.php","key"=>$nombreArchivo);
    $imagenesSubidas[$i]=$archivos;
}

$arr = array("file_id"=>0, "overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
    "initialPreview"=>$imagenesSubidas);

echo json_encode($arr);

?>