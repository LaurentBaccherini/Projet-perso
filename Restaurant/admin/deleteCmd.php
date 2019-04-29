<?php

$id = $_GET['id'];

var_dump($id);

require_once('../libraries/database.php');

deleteCmd($id);

header('Location:commandes.php');

?>