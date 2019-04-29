<?php
require_once('libraries/models/Model.php');

/*Class regroupant les fonctions concernant les catégories*/
class CategoryModel extends Model{

    /*Récupère toutes les catégories de la BDD*/
    function all(){
    
    $resultats = $this->db->query('
        SELECT * FROM categories
    ');
    
    return $resultats->fetchAll();
    
    }
    
    
    function get($id){
        $requete = $this->db->prepare('
            SELECT *
            FROM categories
            WHERE id = :id
        ');
        
        $requete -> execute([
            ':id' => $id
        ]);
        
        return $requete -> fetch();
    }
}

?>