<?php

require_once('flash.php');

$nombre1 = filter_input(INPUT_POST, 'nombre1', FILTER_VALIDATE_FLOAT);
$nombre2 = filter_input(INPUT_POST, 'nombre2', FILTER_VALIDATE_FLOAT);
$operation = $_POST['operation'];

if($nombre1 === false){
    addMessage('error', "Vous devez fournir un premier nombre (obligatoirement un nombre)");
}

if($nombre2 === false){
    addMessage('error', "Vous devez fournir un deuxième nombre (obligatoirement un nombre)");
}

if($operation == "division" && $nombre2 == 0){
    addMessage('error', "Vous demandez une division par 0 : impossible");
} elseif($nombre1 !== false && $nombre2 !== false) {
    switch($operation){
        case "multiplication":
            $resultat = $nombre1 * $nombre2;
            break;
        case "division":
            $resultat = $nombre1 / $nombre2;
            break;
    }
    
    addMessage('success', "Le résultat est : $resultat");
}

header('Location: calculette.php');

?>