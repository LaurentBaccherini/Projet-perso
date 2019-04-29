<?php
session_start();

if (!empty($_POST)) {
    
    // "extract" permet de récuperer les données d'un tableau associatif et les transforme les clefs 
    // du tableau en variable contenant les valeurs des clefs
    extract($_POST);
  // 1 Trouver un utilisateur dans la base qui à cet email
  $db = new PDO('mysql:host=localhost;dbname=Restaurant;charset=utf8', 'root',''); 
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
          $_SESSION['connected'] = true;
          $_SESSION['user'] = $user;
          header('Location: index.php');
      }
  }
}


require_once('templates/header.phtml');

require_once('templates/nav.phtml');

require_once('templates/connexion.phtml');

require_once('templates/footer.phtml');

?>
    



