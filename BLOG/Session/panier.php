<?php
session_start();
$totalProduits = 0;

/*var_dump($_SESSION['panier']);*/
foreach($_SESSION['panier'] as $item){
    $totalProduits += $item['produit']['price'] * $item['quantite'];
}

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
    <table>
        <thead>
            <tr>
                <th>Nom du produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Prix total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($_SESSION['panier'] as $item) : ?>
                <tr>
                    <td><?=$item['produit']['title']?></td>
                    <td><?=$item['produit']['title']?></td>
                    <td><?=$item['quantite']?></td>
                    <td><?=$item['produit']['price']*$item['quantite']?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan=3>Total</td>
                <td><?= $totalProduits?></td>
            </tr>
              <tr>
                <td colspan="3">TVA :</td>
                <td><?= $totalProduits * 0.2 ?> €</td>
            </tr>
            <tr>
                <td colspan="3">Total TTC :</td>
                <td><?= $totalProduits * 1.2 ?> €</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>