<?php

$db = new PDO('mysql:host=localhost;dbname=Restaurant;charset=utf8','root','',[ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$requete = $db -> prepare('
    INSERT INTO users
    SET 
        firstName = :firstName,
        lastName = :lastName,
        email = :email,
        password = :password
');
$userHash = password_hash('Kikou'.$_POST['password'], PASSWORD_BCRYPT);

var_dump($userHash);

$requete -> execute([
        ':firstName' => $_POST['firstName'],
        ':lastName' => $_POST['lastName'],
        ':email' => $_POST['email'],
        ':password' => $userHash
    ]);
    
    

header('Location: connexion.php');
?>