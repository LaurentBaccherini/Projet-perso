<?php

require_once('libraries/controllers/Controller.php');

class userController extends Controller{
    
    protected $modelName = 'UserModel';
    
    protected $viewFolder = 'users';
    
    
    
    public function index(){
        $users = $this->model->all();
        
        $pageTitle = 'Liste des utilisateurs';
        $pageSubtitle = 'Sous-titre';
        
        $variables= compact('users', 'pageTitle', 'pageSubtitle');
        
        $this->display('index', $variables);
        /*var_dump($users);*/
    }
    
    
    public function create(){
        
        $pageTitle = 'Inscription';
        $pageSubtitle = 'Remplissez les champs ci-dessous';
        
        $this->display('create', compact('pageTitle', 'pageSubtitle'));
        
    }
    
    public function save(){
        
/*        var_dump($_POST);*/
        
        $full_name = filter_input(INPUT_POST , 'full_name');
        $email = filter_input(INPUT_POST , 'email', FILTER_VALIDATE_EMAIL);
        $image_url = filter_input(INPUT_POST , 'image_url', FILTER_VALIDATE_URL);
        $description = filter_input(INPUT_POST , 'description', FILTER_DEFAULT);
        $password = filter_input(INPUT_POST , 'password', FILTER_DEFAULT);
        $password_confirm = filter_input(INPUT_POST , 'password_confirm', FILTER_DEFAULT);
        
        $hash = password_hash($password, PASSWORD_BCRYPT);
        
        $data = compact('full_name','email', 'image_url', 'description','hash');
        
        $this->model->save($data);
        
        header('Location:index.php?controller=user&action=login');
        
        
        
    }
    
    public function login(){
        
        $pageTitle = 'Connectez-vous!';
        
        $pageSubtitle = 'Remplissez les champs';
        
        $this->display('login', compact('pageTitle', 'pageSubtitle'));

    }
    
    public function auth(){
        
/*        var_dump($_POST);*/
        
        $email = filter_input(INPUT_POST , 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST , 'password', FILTER_DEFAULT);
        
        $user = $this->model->find("email = '$email'");
        
/*        var_dump($user);*/
        
        if(empty($user)){
            header('Location:index.php?controller=user&action=login');
        }else {
            $verification = password_verify($password, $user->hash);
            if (!$verification) {
                header('Location:index.php?controller=user&action=login');
            }else {
                
                $_SESSION['connected'] = true;
                $_SESSION['user'] = $user;
                header('Location:index.php');
                
                
            }
        }
        
    
        
    }
    
    public function logout(){
        $_SESSION['connected'] = false;
        unset($_SESSION['user']);
        header('Location: index.php');
    }
    
}

?>