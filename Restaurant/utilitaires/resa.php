<?php

require_once('../libraries/database.php');


$data = $_POST;

/*var_dump($data);*/

saveResa($data);

header('Location:../index.php');

?>