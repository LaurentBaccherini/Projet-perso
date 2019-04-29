<?php

class Controller{
    
    /***************Proppriétés de l'objet***************/

    public $model;

    protected $modelName;
    
    protected $viewFolder;
    
    /***************Fonctions de l'objet***************/

        /*Fonction de construction de l'objet.*/
    public function __construct(){
        
        
        require_once('libraries/models/'.$this->modelName.'.php');
        
        //Précision: new $this->modelName() correspond à new 'nom de l'objet'().
        //Ici le nom de l'objet est définie par la variable $modelName,à la création de l'objet; cf fichier 'AnnonceController.php'
        $this->model = new $this->modelName();
    }
    
    
        /*Affiche les templates dont les differentes pages ont besoin*/
    protected function display($viewName, $variables = []){
        
        extract($variables);
        
        require_once('templates/header.phtml');
        
        require_once('templates/'.$this->viewFolder.'/'.$viewName.'.phtml');
        
        require_once('templates/footer.phtml'); 
    }
    
        /*Affiche les templates dont les differentes pages ont besoin; en cas d'erreur*/
    protected function error($variables = []){
        
        $error = true;
        
        extract($variables);
        
        require_once('templates/header.phtml');
        
        require_once('templates/footer.phtml'); 
    }
    
}

?>