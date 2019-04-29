<?php

$id = $_GET['id'];

var_dump($id);

require_once('../libraries/database.php');

deletePlat($id);

header('Location:plats.php');

?>