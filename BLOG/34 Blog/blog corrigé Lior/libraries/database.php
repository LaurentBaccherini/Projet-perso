<?php

$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);


function getArticles(){
    global $db;
    
    // 2. Requete de récupération des articles ordonnés par date de création descendante (ajoutez pour chaque article le titre de la catégorie qui correspond)
    $resultat = $db->query('SELECT 
                                articles.*, 
                                categories.title as categoryTitle
                            FROM articles
                            INNER JOIN categories ON articles.category_id = categories.id
                            ORDER BY articles.created_at DESC
                            ');
                            
    $items = $resultat->fetchAll();
    
    return $items;
}

function getArticle($idArticle){
    global $db;
    
    // 2. Une requete qui récupère les infos de l'article dont l'id est égal à $id (sans oublier le titre de la catégorie)
    $requete = $db->prepare('SELECT 
                                articles.*, 
                                categories.title as categoryTitle
                            FROM articles
                            INNER JOIN categories ON articles.category_id = categories.id
                            WHERE articles.id = :id
                            ');
    
    $requete->execute([':id' => $idArticle]);                    
        
    $article = $requete->fetch();
    
    return $article;
}

function getCategories(){
    global $db;
    
    $resultat = $db->query('SELECT * FROM categories');

    $categories = $resultat->fetchAll();
    
    return $categories;
}

/**
 * Insère un article dans la base de données
 * 
 * @param $title string Le titre de l'article à insérer
 * @param $introdution string L'introduction de l'article
 * @param $content string Le contenu de l'article
 * @param $image_url string L'URL de l'image
 * @param $category_id int L'identifiant de la catégorie
 * @return int L'identifiant du nouvel article
 */
function createArticle($title, $introduction, $content, $image_url, $category_id){
    global $db;
    
    // 2. Préparation de la requete
    $requete = $db->prepare('
        INSERT INTO articles SET 
            title           = :titre, 
            image_url       = :image_url, 
            category_id     = :category_id, 
            introduction    = :introduction, 
            content         = :content, 
            created_at      = NOW(), 
            modified_at     = NOW()
    ');
    
    // 3. Execution de la requete avec les données protégées
    $requete->execute([
        ':titre'        => $title,
        ':image_url'    => $image_url,
        ':introduction' => $introduction,
        ':content'      => $content,
        ':category_id'  => $category_id
    ]);
    
    
    $id = $db->lastInsertId();
    
    return $id;
}

function updateArticle($title, $introduction, $content, $image_url, $category_id, $id){
    global $db;
    
    // 2. Créer la requête
    $requete = $db->prepare('
        UPDATE articles SET
            title = :titre,
            introduction = :intro,
            image_url = :image,
            content = :contenu,
            category_id = :caca
        WHERE id = :identifiant
    ');
    
    // 3. On execute :
    $requete->execute([
        ":titre"        => $title,
        ":intro"        => $introduction,
        ":image"        => $image_url,
        ":contenu"      => $content,
        ":caca"         => $category_id,
        ":identifiant"  => $id
    ]);
}

function deleteArticle($id){
    global $db;
    
    $requete = $db->prepare('
        DELETE FROM articles WHERE id = :id
    ');
    
    $requete->execute([
       ":id" => $id 
    ]);
}

?>