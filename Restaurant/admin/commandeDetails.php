<?php
session_start();

require_once('../libraries/database.php');

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$commandeDetails = detailsCmd($id);

$totalProduits = 0;

foreach($commandeDetails as $item){
    $totalProduits += $item['price'] * $item['quantity'];
}

require_once('templates/header.phtml');

require_once('templates/nav.phtml');

require_once('templates/details.phtml');

require_once('templates/footer.phtml');
?>
    
