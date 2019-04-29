<?php

// TODO : Sécuriser et être bien sur qu'on nous a filé un identifiant
$id = $_GET['id'];

// 1. Connexion
require_once('libraries/database.php');

// 2. Récupérer les catégories
$categories = getCategories();

// 3. Récupérer l'article
$article = getArticle($id);

require_once('templates/header.phtml');

require_once('templates/articles/edit.phtml');

require_once('templates/footer.phtml'); ?>