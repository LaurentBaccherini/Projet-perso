<?php

// 1. Connexion à la base de données
require_once('database.php');

$task = $_GET['task'];

if($task == "update"){
    updateArticleTask();
} elseif($task == "delete"){
    deleteArticleTask();
} elseif($task == "save"){
    saveArticleTask();
}

function updateArticleTask(){
    // 0. Extraire les variables du POST
    $title          = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $introduction   = filter_input(INPUT_POST, 'introduction', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id    = filter_input(INPUT_POST,'category_id', FILTER_VALIDATE_INT);
    $content        = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $image_url      = filter_input(INPUT_POST, 'image_url', FILTER_VALIDATE_URL);
    $id             = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    
    
    
    $errorMessage = '';
    
    if(!$id){
        $errorMessage .= "<p>Il faut absolument un identifiant d'article !</p>";
    }
    
    if(!$introduction){
        $errorMessage .= "<p>Vous devez entrer une introduction !</p>";
    }
    
    if(!$content){
        $errorMessage .= "<p>Vous devez entrer un contenu !</p>";
    }
    
    if(!$errorMessage){
        
        updateArticle($title, $introduction, $content, $image_url, $category_id, $id);
        
        header('Location: ../article.php?id=' . $id);
    } else {
        // Retourner sur la page de modification
        header('Location: ../article-edit.php?id=' . $id . '&errorMessage=' . $errorMessage);
    }
}

function deleteArticleTask(){
    // 0. On prend l'ID
    $id = $_GET['id'];
    
    
    // 2. On prépare
    deleteArticle($id);
    
    header('Location: ../index.php');
}

function saveArticleTask(){
    // 1. Extraction des données du POST
    $title          = $_POST['title'];
    $introduction   = $_POST['introduction'];
    $content        = $_POST['content'];
    $image_url      = $_POST['image_url'];
    $category_id    = $_POST['category_id'];
    
    $id = createArticle($title, $introduction, $content, $image_url, $category_id);
    
    header('Location: ../article.php?id=' . $id);
}

?>