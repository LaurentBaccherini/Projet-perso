<?php


require_once('../libraries/database.php');

/*var_dump($_POST);*/

$fullName    = filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_STRING);
$adress    = filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_STRING);
$postalCode      = filter_input(INPUT_POST, 'postalCode', FILTER_VALIDATE_INT);
$city    = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
$telephone      = filter_input(INPUT_POST, 'telephone', FILTER_DEFAULT);

$data = compact('fullName', 'adress','postalCode','city', 'telephone');

/*var_dump($data);*/

$lastId = saveInfos($data);



foreach ($_SESSION['panier'] as $item){
   /* var_dump($item);*/
   
   $id = $item['produit']['id'];
   $quantity = $item['quantite'];
   $unitPrice = $item['produit']['price'];
   
   $data = compact('lastId', 'id', 'quantity','unitPrice');
   
   saveDetails($data);
   
    $_SESSION['panier'  ] = [];
}



header('Location:../index.php');

?>