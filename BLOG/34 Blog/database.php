<?php

/*********************************************************************************************/
// Connexion à la Base de données
$connexion = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', '', [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

/*********************************************************************************************/
// Fonction permettant d'afficher tous les articles de la BDD dans l'index.
function afficherArticles(){
    global $connexion;
    $requete = $connexion -> prepare('SELECT articles.*, categories.title AS categoryTitle
    FROM articles
    INNER JOIN categories on articles.category_id = categories.id
    ORDER BY articles.created_at DESC');
    $requete ->  execute();
    return $requete -> fetchAll(PDO::FETCH_ASSOC);
    /*var_dump($articles);*/
}


/*********************************************************************************************/
// Fonction permettant d'afficher le détails des articles.
function detailsArticle($id){
    global $connexion;
    $requete = $connexion -> prepare('
        SELECT articles.*, categories.title AS categoryTitle
        FROM articles
        INNER JOIN categories on articles.category_id = categories.id
        WHERE articles.id = :id');
    $requete -> execute([
    ':id' => $id
    ]);
    return $requete -> fetch();
    
}

/*********************************************************************************************/
// Fonction permettant d'ajouter un article de la BDD.
function ajouterArticle($data){   
    global $connexion;
    $requete = $connexion -> prepare('
    INSERT INTO articles
        (title, created_at, modified_at, introduction, content, image_url, category_id) 
    VALUES 
        (:title, NOW(), NOW(), :introduction, :content, :image_url, :category_id)');
    $requete ->  execute([
        ':title' => $data['title'],
        ':introduction' => $data['introduction'],
        ':content' => $data['content'],
        ':image_url' => $data['image_url'],
        ':category_id' => $data['category_id']
    ]);
    $idNewArticle = $connexion -> lastInsertId();
    return $idNewArticle;
    
    
}


/*********************************************************************************************/
// Fonction permettant de modifier un article de la BDD.
function modifierArticle($data){
    global $connexion;
    $requete = $connexion -> prepare('
    UPDATE articles
    SET 
    title        = :title, 
    modified_at  = NOW(),
    introduction = :introduction, 
    content      = :content, 
    image_url    = :image_url, 
    category_id  = :category_id
    WHERE 
    id           = :id');
    $requete ->  execute([
        ':title' => $data['title'],
        ':introduction' => $data['introduction'],
        ':content' => $data['content'],
        ':image_url' => $data['image_url'],
        ':category_id' => $data['category_id'],
        ':id' =>$data['id']
    ]);
    
    header('location:article.php?id='.$data['id'].'');

}


/*********************************************************************************************/
// Fonction permettant de récupérer la catégorie d'un article de la BDD.
function cateArticle(){
    global $connexion;
    $requete = $connexion -> prepare('
    SELECT*
    FROM categories');
    $requete ->  execute();
    return $requete -> fetchAll(PDO::FETCH_ASSOC);
}


/*********************************************************************************************/
// Fonction permettant de supprimer un article de la BDD.

function supprimer($IDSuppr){
    global $connexion;
    $requete = $connexion -> prepare('
    DELETE
    FROM articles
    WHERE id= :id');
    $requete ->  execute([
        ':id' => $IDSuppr
    ]);

    header('location:index.php?');
}


/*********************************************************************************************/
// Fonction permettant d'ajouter un commentaire de la BDD.
function commentaire($data){
    global $connexion;
    $requete = $connexion -> prepare('
    INSERT INTO commentaires
        (title, content, logUser, created_at, article_id) 
    VALUES 
        (:title, :content, :logUser, NOW(), :article_id)');
    $requete ->  execute([
        ':title' => $data['titreCom'],
        ':logUser' => $data['pseudo'],
        ':content' => $data['contentCom'],
        ':article_id' => $data['id_art']
    ]);
    
    header('location:article.php?id='.$data['id_art'].'');
    
}


/*********************************************************************************************/
// Fonction permettant d'afficher un commentaire enregistrés dans la BDD.
function afficherCom($id){
    global $connexion;
    $requete = $connexion -> prepare('
    SELECT*
    FROM commentaires
    WHERE article_id = :id');
    $requete ->  execute([
        ':id' => $id
    ]);
        
    return $requete -> fetchAll(PDO::FETCH_ASSOC);
    
    
}


?>
