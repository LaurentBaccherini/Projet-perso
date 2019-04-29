<?php
session_start();

$id = $_GET['id'];

$db = new PDO('mysql:host=localhost;dbname=Boutique;charset=utf8','root','',[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$requete = $db -> prepare('
    SELECT * 
    FROM products
    WHERE id = :id
');

$requete -> execute([
        ':id' => $id
    ]);
    
$produit = $requete -> fetch(PDO::FETCH_ASSOC);

var_dump($produit);

// 1 Verifier que le panier existe
if (!array_key_exists('panier',$_SESSION)) {
    $_SESSION['panier'] = [];
}

// 2 Verifier si le produits existe deja dans le panier
if (!array_key_exists($id, $_SESSION['panier'])) {
    // Ajouter le produits dans le panier à la position $id
    $_SESSION['panier'][$id] = [
            'produit' => $produit,
            'quantite' => 1
        ];
        
}else {
    $_SESSION['panier'][$id]['quantite']++;
}


/*var_dump($_SESSION['panier']);*/
header('Location:produits.php');
?>