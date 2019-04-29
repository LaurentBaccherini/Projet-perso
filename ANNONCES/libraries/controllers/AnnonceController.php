<?php

require_once('libraries/controllers/Controller.php');

class AnnonceController extends Controller{
    
    // C'est ici on qu'on définie le modele d'objet que l'on souhaite appliqué a l'objet 'AnnonceController'
    protected $modelName = 'AnnonceModel';
    protected $viewFolder = 'annonces';

    
/***************Fonctions de l'objet***************/
    
    /*Affiche la page d'accueuil*/
    public function homepage(){
        
        
        $populaires = $this->model->getPopulars();
        $derniers = $this->model->getLasts();
        $pageTitle = "Bienvenue sur notre site de petites annonces";
        $pageSubtitle = "Retrouvez nos meilleures annonces appartements et voitures!";
        
        $variables = compact('populaires', 'derniers', 'pageTitle', 'pageSubtitle');
        $this->display('homepage',$variables);
    }
    
    /*Affiche toutes les annonces d'une catégorie données*/
    public function category(){
        
        $id = filter_input(INPUT_GET,'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            $pageTitle    = "Erreur : aucun identifiant spécifié";
            $pageSubtitle = "Vous devez préciser l'identifiant de l'annonce et celui-ci doit etre un nombre";
            
            $variables = compact('error','pageTitle', 'pageSubtitle');
            $this->error($variables);
            
        }else {
            
            require_once('libraries/models/CategoryModel.php');
            
            $modelCategory = new CategoryModel();
            
            $category = $modelCategory->get($id);
            
            if (empty($category)) {
                $pageTitle    = "Erreur : aucun identifiant spécifié";
                $pageSubtitle = "Il n'y a aucune catégorie correspondante à l'identifiant renseigné";
                
                $variables = compact('error','pageTitle', 'pageSubtitle');
                $this->error($variables);
                
            }else {
                
                $derniers = $this->model->fromCategory($id);
                
                $variables = compact('pageTitle','pageSubtitle','derniers', 'category');
                $this->display('category', $variables);
                
                /*var_dump($annonces);*/
                
            }
            
        }
  
    }

    /*Affiche le détail d'une annonce*/
    public function show(){

        
        $id=filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            $pageTitle    = "Erreur : aucun identifiant spécifié";
            $pageSubtitle = "Vous devez préciser l'identifiant de l'annonce et celui-ci doit etre un nombre";
            
            $variables = compact('error','pageTitle', 'pageSubtitle');
            $this->error($variables);
            
        }else {
            $annonce = $this->model->get($id);
            if (!$annonce) {
             
            $pageTitle    = "Erreur : aucune annonce trouvée avec l'identifiant spécifié";
            $pageSubtitle = "Aucune annonce ne correspond à l'identifiant que vous avez demandé";
            
            $variables = compact('error','pageTitle', 'pageSubtitle');
            $this->error($variables);
            
            }else {
            $pageTitle = $annonce->title;
            $pageSubtitle = "Dans la catégorie: ".$annonce->category_title;
            
            $variables = compact('pageTitle','pageSubtitle','annonce');
            $this->display('show', $variables);
            }
 
        }

    }
    
    /*Valide et renvoie vers une création ou une modification d'annonce*/
    public function save(){

        
        $id                 = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $title              = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $image_url          = filter_input(INPUT_POST, 'image_url', FILTER_VALIDATE_URL);
        $price              = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $short_description  = filter_input(INPUT_POST, 'short_description', FILTER_SANITIZE_STRING);
        $description        = filter_input(INPUT_POST, 'description', FILTER_DEFAULT);
        $category_id        = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        
        $user_id = 3;
        
        if (!$title || !$image_url || !$price || !$short_description || !$description || !$category_id) {
            // code...
        }else {
            $marqueurs = compact('title', 'image_url', 'short_description', 'description', 'category_id', 'price', 'user_id');
            
            if($id){
                $marqueurs['id'] = $id;
                $this->model->save($marqueurs);
            } else {
                $marqueurs['created_at'] = date('Y-m-d H:i:s');
                $id = $this->model->save($marqueurs);
            }
            
            header('Location: index.php?action=show&id='. $id);  
        
        }
    }

    /*Crée une annonce en fonction des infos transmises dans les champs*/
    public function create(){
        require_once('libraries/models/CategoryModel.php');

        $category = new CategoryModel();
    
        $categories = $category->all();
        
        $pageTitle    = "Créez votre annonce!";
        $pageSubtitle = "Veuillez saisir les données à modifier";
        
        $variables = compact('pageTitle','pageSubtitle','categories');
        $this->display('create', $variables);
    }

    /*Récupère les catègories et les infos d'une annonce en vue d'une modification*/
    public function edit(){
        require_once('libraries/models/CategoryModel.php');
        
        $category = new CategoryModel();
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            $pageTitle    = "Erreur : aucune annonce trouvée avec l'identifiant spécifié";
            $pageSubtitle = "Aucune annonce ne correspond à l'identifiant que vous avez demandé";
            
            $variables = compact('error','pageTitle', 'pageSubtitle');
            $this->error($variables);
            
        }else {
            $annonce = $this->model->get($id);
            $categories = $category->all();
         
            if (!$annonce) {
                
                $pageTitle    = "Erreur : aucune annonce trouvée avec l'identifiant spécifié";
                $pageSubtitle = "Aucune annonce ne correspond à l'identifiant que vous avez demandé";
                
                $variables = compact('error','pageTitle', 'pageSubtitle');
                $this->error($variables);
            
            }else {
                
                $pageTitle = $annonce->title;
                $pageSubtitle = "Dans la catégorie: ".$annonce->category_title;
                
                $variables = compact('pageTitle','pageSubtitle','annonce', 'categories');
                $this->display('edit', $variables);
            
            }
        
        }
        
        $pageTitle    = "Modifier : $annonce->title";
        $pageSubtitle = "Veuillez saisir les données à modifier";
        
        
    }

    /*Efface une annonce de la base de données*/
    public function delete(){

        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            $variables = compact('error','pageTitle', 'pageSubtitle');
            $this->error($variables);
            
        }else {
        
            $delete = $this->model->delete($id);
            
            header('Location:index.php?action=homepage');
        }
    }
}

?>