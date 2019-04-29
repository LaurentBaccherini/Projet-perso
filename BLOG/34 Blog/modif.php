<?php
require('database.php');
$data = $_POST;
$newArticleID = modifierArticle($data);
?>