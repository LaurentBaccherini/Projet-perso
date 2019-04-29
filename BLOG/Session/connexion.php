<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form action="" method ="POST">
        <input type="text" name="email" placeholder ="Votre email">
        <input type="password" name="password" placeholder="Votre mot de passe">
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
<?php
session_start();
/*var_dump($_POST);*/
if (!empty($_POST)) {
    
    // "extract" permet de récuperer les données d'un tableau associatif et les transforme les clefs 
    // du tableau en variable contenant les valeurs des clefs
    extract($_POST);
  // 1 Trouver un utilisateur dans la base qui à cet email
  $db = new PDO('mysql:host=localhost;dbname=Boutique;charset=utf8', 'root','');
  $requete = $db -> prepare('
    SELECT *
    FROM users
    WHERE email = :email
  ');
  $requete -> execute([
      ':email' => $email
      ]);
  
  $user = $requete -> fetch(PDO::FETCH_ASSOC)   ;
  if (!$user) {
      echo('Vous n\'avez pas de compte chez nous');
  }
/*  var_dump($user);*/
  // 2 Verififer si son password correspond au hash de la BDD
  else {
      $userHash = $user['password'];
      $verification = password_verify('Kikou'.$password,$userHash);
      var_dump($verification);
      
      if (!$verification) {
          echo('identifiants invalide');
          
      }else {
          $_SESSION['connecte'] = true;
          $_SESSION['user'] = $user;
          header('Location: index.php');
      }
  }
}
?>


