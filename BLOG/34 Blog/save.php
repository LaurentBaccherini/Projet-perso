<?php

require('database.php');
$data = $_POST;
$newArticleID = ajouterArticle($data);
/*var_dump($newArticle);*/
header('location:article.php?id='.$newArticleID.'');


?>