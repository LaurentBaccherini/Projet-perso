<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Indcription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form action="admin/save-user.php" method="POST">
        <input type="text" name =firstName placeholder ="prenom">
        <input type="text" name="lastName" placeholder =" nom de famille">
        <input type="email" name="email" placeholder ="email">
        <input type="password" name ="password" placeholder ="Mot de passe">
        <button type="submit">Valider!</button>
    </form>
</body>
</html>