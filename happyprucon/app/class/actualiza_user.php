<?php

require'sessions.php';

require'../../seguridad/users.php';

$objuser = new Users();
$objuser->update_user();



?>