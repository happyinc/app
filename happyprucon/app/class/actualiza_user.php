<?php

require'sessions.php';

require'users.php';

$objuser = new Users();
$objuser->update_user();



?>