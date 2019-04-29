<?php

session_start();

/*session_destroy();*/

require_once('../libraries/database.php');

$id = $_GET['id'];

$newplat = detailsPlat($id);

var_dump($newplat);

 // 1 Verifier que le panier existe
    if (!array_key_exists('panier',$_SESSION)) {
        $_SESSION['panier'] = [];
    }
    
    // 2 Verifier si le produits existe deja dans le panier
    if (!array_key_exists($id, $_SESSION['panier'])) {
        // Ajouter le produits dans le panier à la position $id
            $_SESSION['panier'][$id] = [
                    'produit' => $newplat,
                    'quantite' => 1
                ];
            
    }else {
        $_SESSION['panier'][$id]['quantite']++;
    }
    
    $totalProduits = 0;

    if (array_key_exists('panier', $_SESSION)) {
        foreach ($_SESSION['panier'] as $item  ) {
            $quantite = $item['quantite'];
            $totalProduits = $totalProduits + $quantite;
        }
    }

header('Location:../index.php');



?>

