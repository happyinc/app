<?php
//archivo de connexion a la bd de happy...
require"../../externo/plugins/PDOModel.php";

$pdomodel = new PDOModel();
$pdomodel->connect('happyhappyinc.com','bd_happy','bd_happy2017*','bd_happy');

?>