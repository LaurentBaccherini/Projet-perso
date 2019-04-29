<?php

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$errorMessage = '';

if(!$id){
    $errorMessage = "Vous devez renseigner un identifiant pour l'article et celui-ci doit être nombre";
} else {
    // 1. Connexion à la base
    require_once('libraries/database.php');
    
    $article = getArticle($id);
}


require('templates/header.phtml');

if(!$errorMessage) require('templates/articles/details.phtml');

require('templates/footer.phtml'); 

?>