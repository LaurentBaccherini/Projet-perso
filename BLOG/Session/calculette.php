<?php

require_once('flash.php');

$flashMessages = getMessages();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <h1>Bienvenue dans la calculette</h1>
    
    <?php foreach($flashMessages as $type => $messages): ?>
        <?php if(!empty($messages)) : ?>
            <div class="flash <?= $type ?>">
                <?php foreach($messages as $message) : ?>
                    <p><?= $message ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    
    <form action="calcul.php" method="POST">
        <input type="text" name="nombre1" placeholder="Premier nombre">
        <input type="text" name="nombre2" placeholder="Deuxième nombre">
        <select name="operation">
            <option value="multiplication">Multiplication</option>
            <option value="division">Division</option>
        </select>
        <button type="submit">Calculer</button>
    </form>
</body>
</html>