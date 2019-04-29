<?php

/*classe définissant la requete de connexion à la BDD*/
abstract class Model{
        public $db;
    
    
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=annonces;cahrset=utf8', 'root', '', 
                    [ PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    
    public function all($where = '', $order = '', $limit = ''){
        $sql = 'SELECT * FROM '. $this->tableName;
        
        if(!empty($where)) $sql .= ' WHERE ' . $where;
        if(!empty($order)) $sql .= ' ORDER BY ' . $order;
        if(!empty($limit)) $sql .= ' LIMIT ' . $limit;
        
        $resultats = $this->db->query($sql);
        
        return $resultats->fetchAll();
    }
    
    public function find($where){
        $sql = 'SELECT * FROM '. $this->tableName.' WHERE ' . $where;
        
        $requete = $this->db->query($sql);
        
        
        return $requete ->fetch();
    }
    
    public function get($id){
        $requete = $this->db->prepare('
            SELECT * FROM '. $this->tableName .'
            WHERE id = :id
        ');
        
        $requete->execute([':id' => $id]);
        
        return $requete->fetch();
    }
    
    public function save($data){
        $sql = '';
        
        if(!empty($data['id'])){
            $sql = 'UPDATE ';
        } else {
            $sql = 'INSERT INTO ';
        }
        
        $sql .= $this->tableName.' SET ';
        
        $marqueurs = [];
        foreach($data as $cle => $valeur){
            $marqueurs[] = "$cle = :$cle";
        }
        
        $sql .= join($marqueurs, ', ');
        
        if(!empty($data['id'])){
            $sql .= ' WHERE id = :id';
        }
                
        $requete = $this->db->prepare($sql);
        
        $requete->execute($data);
        
        if(empty($data['id'])){
            return $this->db->lastInsertId();
        }
    }

    public function delete($id){
        $requete = $this->db->prepare('
            DELETE FROM '.$this->tableName.'
            WHERE id = :id
        ');
        
        $requete->execute([':id' => $id]);
    }
    
    
}

?>