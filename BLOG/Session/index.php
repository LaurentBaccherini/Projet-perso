<?php   

session_start();

/*$secret = 'Kikou';
$password1 = password_hash($secret.'bonjour',PASSWORD_BCRYPT);
$password2 = password_hash($secret.'salut',PASSWORD_BCRYPT);*/

$vrai = password_verify($secret.'bonjour', $password1);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>
<body>
    <H1>Session découverte</H1>
    <?php if(empty($_SESSION['connecte'])) : ?>
        <p>Vous n'etes pas connecté</p>
        <a href="connexion.php">Connexion</a>
    <?php else : ?>
        <p>Vous etes connecté en tant que <?= $_SESSION['user']['firstName']?> </p>
        <a href="deconnexion.php">Déconnexion</a>
    <?php endif; ?>
    <a href="produits.php">Liste des produits</a>
  
    
</body>
</html>