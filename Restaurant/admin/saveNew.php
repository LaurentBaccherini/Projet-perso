<?php

require_once('../libraries/database.php');

$name    = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$imageUrl    = filter_input(INPUT_POST, 'imageUrl', FILTER_VALIDATE_URL);
$description      = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);
$stock    = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
$price      = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

$data = compact('name', 'imageUrl','description','stock', 'price');

var_dump($data);

newPlat($data);

header('Location:plats.php');

?>