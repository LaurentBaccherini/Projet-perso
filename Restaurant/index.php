<?php

session_start();

require_once('libraries/database.php');

if (!empty ($_SESSION['panier'])) {
    $totalProduits = 0;
    
    
    foreach($_SESSION['panier'] as $item){
        $totalProduits += $item['produit']['price'] * $item['quantite'];
    }
}


$plats = listePlats();
/*var_dump($plats);*/

require_once('templates/header.phtml');

require_once('templates/index.phtml');

require_once('templates/footer.phtml');

?>




    
