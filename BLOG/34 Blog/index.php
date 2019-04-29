<?php

require('database.php');
$articles = afficherArticles();
require('templates/header.phtml');
require('templates/articles/index.phtml');

require('templates/footer.phtml');



?>
