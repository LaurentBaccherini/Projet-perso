<?php
require('database.php');


$id = $_GET['id'];
// Verifie si $_GET['id'] est remplie ou non.
if (empty($_GET['id'])) {
	echo 'Erreur';
	exit();
	
}

$articleDetails = detailsArticle($id);
$coms = afficherCom($id);


require('templates/header.phtml');

require('templates/articles/details.phtml');

require('templates/formulaires.phtml');
?>
      <!-- Script JS pour afficher les commentaires en dynamique via AJAX-->

    <script type="text/javascript"> 
     let infosForm =  document.querySelector('#saveComment')
     infosForm.addEventListener('submit',recComs);
     
    </script>
    
<?php
require('templates/footer.phtml');
?>