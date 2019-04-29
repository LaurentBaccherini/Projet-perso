<?php
session_start();

$_SESSION['connected'] = false;
unset($_SESSION['user']);
header('location: connexion.php');
?>