<?php

// 1. Connexion à la base de données
require_once('libraries/database.php');

$articles = getArticles();

require('templates/header.phtml');

require('templates/articles/index.phtml');

require('templates/footer.phtml'); 

?>