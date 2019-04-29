<?php
require('database.php');

$id = $_GET['id'];
// Verifie si $_GET['id'] est remplie ou non.
if (empty($_GET['id'])) {
	echo 'Erreur';
	exit();
	
}

supprimer($id);


?>
