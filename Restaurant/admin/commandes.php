<?php


require_once('../libraries/database.php');

$commandes = listeCmd();

require_once('templates/header.phtml');

require_once('templates/nav.phtml');

require_once('templates/cmd.phtml');

require_once('templates/footer.phtml');
?>

        

