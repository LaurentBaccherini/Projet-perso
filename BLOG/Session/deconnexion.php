<?php
session_start();

$_SESSION['connecte'] = false;
unset($_SESSION['user']);
header('location: connexion.php');
?>