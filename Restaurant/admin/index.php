<?php

session_start();

if (!$_SESSION['connected']) {
    header('Location:connexion.php');
}

require_once('../libraries/database.php');


require_once('templates/header.phtml');

require_once('templates/nav.phtml');

require_once('templates/nav.phtml');

require_once('templates/footer.phtml');
?>



    
