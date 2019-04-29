<?php

// 1. Connexion à la base de données
require_once('libraries/database.php');

// 2. Récupérer les catégories
$categories = getCategories();


require('templates/header.phtml');

require('templates/articles/new.phtml');

require('templates/footer.phtml'); ?>