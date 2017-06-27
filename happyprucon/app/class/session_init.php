<?php

//nos conectamos a la base de datos
require'sessions.php';



require'../../seguridad/verificar.php';

$objver = new Verificar();
$objver->login_in();

?>