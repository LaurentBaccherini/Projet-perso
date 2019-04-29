<?php

require_once('../libraries/database.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

var_dump($_SESSION['panier'][$id]);

unsetPanier($id);

header('Location:../index.php');


?>