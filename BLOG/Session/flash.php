<?php

session_start();

function addMessage($type, $message){
    $_SESSION['messages'][$type][] = $message;
}

function getMessages(){
    $messages = $_SESSION['messages'];
    unset($_SESSION['messages']);
    return $messages;
}

?>