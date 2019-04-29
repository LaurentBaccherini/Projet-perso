<?php
session_start();


$db = new PDO('mysql:host=localhost;dbname=Restaurant;charset=utf8', 'root', '', [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);


function listePlats(){
    
    global $db;
    
    $requete = $db -> prepare('
        SELECT* 
        FROM plats
    ');
    
    $requete -> execute();
    
    return $requete -> fetchAll(PDO::FETCH_ASSOC);
}

function detailsPlat($id){
    
    global $db;
    
    $requete = $db -> prepare('
        
        SELECT * 
        FROM plats 
        WHERE id = :id
        
    ');
    
    $requete -> execute([
        ':id'  => $id
    ]);
    
    return $requete -> fetch(PDO::FETCH_ASSOC);
    
}

function saveInfos($data){  
    
    global $db;
    
    $requete = $db -> prepare('
        INSERT INTO commandes SET
            dateCommande = NOW(),
            fullName = :fullName ,
            adress = :adress  ,
            postalCode = :postalCode,
            city = :city,
            telephone = :telephone
    ');
    
    $requete -> execute($data);
    
    return $db -> lastInsertId();
    
}

function saveDetails($data){
    
    global $db;
    
    $requete = $db -> prepare('
        
        INSERT INTO commandesDetails SET
            idCommande = :lastId,
            idPlat = :id,
            quantity = :quantity,
            unitPrice = :unitPrice
        
    ');
    $requete -> execute($data);
    
    
    
}

function saveResa($data){
    
    global $db;
    
    $requete = $db -> prepare('
        
        INSERT INTO reservation SET
        
            fullName = :fullName,
            dateResa = :dateResa,
            personNumber = :personNumber,
            telephone = :telephone
        
    ');
    
    $requete -> execute([
        
        'fullName' => $data['fullName'],
        'dateResa' => $data['dateResa'],
        'personNumber' => $data['personNumber'],
        'telephone' => $data['telephone']
         
    ]);
    
    
}

function listeResa(){
    
    global $db;
    
    $requete = $db -> prepare('
        SELECT *
        FROM reservation
    ');
    
    $requete -> execute();
    
    return $requete -> fetchall(PDO::FETCH_ASSOC);
    
}
  
function listeCmd(){
    
    global $db;
    
    $requete = $db -> prepare('
        SELECT *
        FROM commandes
    ');
    
    $requete -> execute();
    
    return $requete -> fetchall(PDO::FETCH_ASSOC);
    
}

function newplat($data){
    
    global $db;
    
    $requete = $db -> prepare('
    
        INSERT INTO plats SET
            
            name = :name,
            imageUrl = :imageUrl,
            description = :description,
            stock = :stock,
            price = :price
    
    ');
    
    $requete -> execute($data);
    
    
}

function modifPlat($data){
    
    global $db;
    
    $requete =$db -> prepare('
    
        UPDATE plats SET
    
            name = :name,
            imageUrl = :imageUrl,
            description = :description,
            stock = :stock,
            price = :price
        
        WHERE id = :id
    
    ');
    
    $requete -> execute($data);
    
}

function deletePlat($id){
    
    global $db;
    
    $requete = $db -> prepare('
    
        DELETE
        FROM plats
        WHERE id = :id
    ');
    
    $requete -> execute([
       ':id' => $id 
    ]);
}

function deleteCmd($id){
    global $db;
    
    $requete = $db -> prepare('
    
        DELETE
        FROM commandes
        WHERE id = :id
    ');
    
    $requete -> execute([
       ':id' => $id 
    ]);
}

function detailsCmd($id){
    
    global $db;
    
    $requete = $db -> prepare('
    
        SELECT plats.name, plats.price, commandesDetails.quantity, commandesDetails.idCommande,
        ROUND((commandesDetails.quantity*plats.price),2)AS total
        From plats
        INNER JOIN commandesDetails ON commandesDetails.idPlat = plats.id
        WHERE commandesDetails.idCommande = :id
    
    ');
    
    $requete -> execute([
       
       'id' => $id
        
    ]);
    
    return $requete -> fetchAll(PDO::FETCH_ASSOC);
    
}

function erase($item ){
    
    $_SESSION['panier'] = [];
    
}

function plusPanier($id){
    
    $_SESSION['panier'][$id]['quantite']++;
    
}

function moinsPanier($id){
    
    $_SESSION['panier'][$id]['quantite']--;
    
}

function unsetPanier($id){
    
    unset($_SESSION['panier'][$id]);
    
}





?>