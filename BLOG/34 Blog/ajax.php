<?php  
require('database.php');
$data = $_POST;
/* Redéfinie le $id recu la fonction Js recComs*/
$id = $_GET['id'];
// Verifie si $_GET['id'] est remplie ou non.
if (empty($_GET['id'])) {
	echo 'Erreur';
	exit();
	
}

$coms = afficherCom($id);


?>
<!-- Boucle foreach pour réafficher tous les commentaires liés à l'd spécifié en GET-->
        <?php foreach ($coms as $com):?>
            <article>
                <h1><?=$com['title']?></h1>
                <p><?=$com['logUser']?></p>
                <p><?=$com['created_at']?></p>
                <p><?=$com['content']?></p>
            </article>
        <?php endforeach; ?>