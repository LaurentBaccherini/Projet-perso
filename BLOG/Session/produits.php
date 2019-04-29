<?php
$db = new PDO('mysql:host=localhost;dbname=Boutique;charset=utf8','root','',[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
session_start();
/*session_destroy();*/


$totalProduits = 0;

if (array_key_exists('panier', $_SESSION)) {
    foreach ($_SESSION['panier'] as $item  ) {
        $quantite = $item['quantite'];
        $totalProduits = $totalProduits + $quantite;
    }
}

var_dump($totalProduits);
    
$requete = $db -> prepare('
    SELECT *
    FROM products
');

$requete -> execute();
$produits = $requete -> fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Liste Produits</h1>

<!-- Affichage de la liste-->
 <?php foreach($produits as $produit) : ?>
    <h3><?= $produit['title'] ?></h3>
    <p><?= $produit['price'] ?> €</p>
    <p><?= $produit['description'] ?></p>
    <a href="ajout-panier.php?id=<?= $produit['id'] ?>">Ajouter au panier</a>
<?php endforeach ?>
    
<a href="panier.php">Voir panier</a>
  
</body>
</html>