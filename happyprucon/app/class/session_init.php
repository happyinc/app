<?php

//nos conectamos a la base de datos
require'sessions.php';

require'../../seguridad/users.php';

$objuser = new Users();
$objuser->login_in();

?>