<?php


require_once('../libraries/database.php');

$resas = listeResa();

require_once('templates/header.phtml');

require_once('templates/nav.phtml');

require_once('templates/reservation.phtml');

require_once('templates/footer.phtml');
?>




