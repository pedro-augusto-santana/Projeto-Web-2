<?php
$_POST = json_decode(file_get_contents('php://input', true), true);
if ($_POST['action'] == 'getRole') {
    User::getRole($_POST['email']);
}

?>
