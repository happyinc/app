<?php

require'sessions.php';

require'../../seguridad/users.php';

$objuser = new Users();
$objuser->delete_user();



?>