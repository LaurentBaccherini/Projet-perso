<?php
require('database.php');


$id = $_GET['id'];
// Verifie si $_GET['id'] est remplie ou non.
if (empty($_GET['id'])) {
	echo 'Erreur';
	exit();
	
}


$articleDetails = detailsArticle($id);
$categoriesArticle = cateArticle();


require('templates/header.phtml');

require('templates/articles/edition.phtml');

require('templates/footer.phtml');



?>
