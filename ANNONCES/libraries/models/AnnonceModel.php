<?php
require_once('libraries/models/Model.php');


/*Classe contenant les fonction utilitaires concernant les annonces*/
class AnnonceModel extends Model{
    
/***************Proppriétés de l'objet***************/

protected $tableName = 'annonces';

/***************Fonctions de l'objet***************/
    
    /*Récupere les 3 annonces les plus populaires*/   
    public function getPopulars(){
        $this->db;
        
        $requete = $this->db->prepare('
            SELECT annonces.*, users.full_name, categories.title as categoty_title
            FROM annonces
            INNER JOIN users ON users.id = annonces.user_id
            INNER JOIN categories ON categories.id = annonces.category_id
            LIMIT 3
        ');
        $requete -> execute();
        return  $requete -> fetchAll();
    }
    
    /*Affiche touteles annonces d'une catégorie*/
    public function fromCategory($id){
        
        $requete = $this->db->prepare('
            SELECT annonces.*, users.full_name, categories.title as categoty_title
            FROM annonces
            INNER JOIN users ON users.id = annonces.user_id
            INNER JOIN categories ON categories.id = annonces.category_id
            WHERE categories.id = :id
        ');
        $requete -> execute([
            ':id' => $id    
        ]);
        return  $requete -> fetchAll();
        
    }
    
    /*Récupere les 12 dernières*/   
    public function getLasts(){
        
        $requete = $this->db->prepare('
            SELECT annonces.*, users.full_name, categories.title as categoty_title
            FROM annonces
            INNER JOIN users ON users.id = annonces.user_id
            INNER JOIN categories ON categories.id = annonces.category_id
            ORDER BY created_at DESC
            LIMIT 12
        ');
        $requete -> execute();
        return  $requete -> fetchAll();
    }
    
    
    /*Récupere les détails en fonction de son id*/   
    public function get($id){

        $requete = $this->db -> prepare('
            SELECT annonces.*, 
            users.full_name, 
            users.description as user_description, 
            users.email, users.image_url as user_image_url, 
            categories.title as category_title
            FROM annonces
            INNER JOIN users ON annonces.user_id = users.id
            INNER JOIN categories ON annonces.category_id = categories.id
            WHERE annonces.id = :id
       ');
       
       $requete -> execute([
            ':id' => $id
       ]);
       
       return $requete -> fetch();
 
    }

    
    
}

?>