<?php

require_once('../libraries/database.php');

$id = $_GET['id'];

$details = detailsPlat($id);

require_once('templates/header.phtml');

require_once('templates/nav.phtml');

require_once('templates/modifier.phtml');

require_once('templates/footer.phtml');

?>


        
