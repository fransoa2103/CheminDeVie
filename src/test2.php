<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>CHEMIN DE VIE de,<h1>
    <?php
    echo '<p>'.$_SESSION['user']['prenoms'].'.</p>';
    echo '<p> Le nom de naissance de votre père est: '.$_SESSION['user']['nomPere'].'.</p>';
    echo '<p> Le nom de naissance de votre mère est: '.$_SESSION['user']['nomMere'].'.</p>';
    echo '<p> Vous est né(e) le '.$_SESSION['user']['birthday'].'</p>';
    echo '<p> Et voici votre chemin de Vie:'.'</p>';
    for($i = 0; $i<8; $i++){
        echo $_SESSION['user']['formule'.$i].' > '.$_SESSION['user']['resultat'.$i].'</br>';
    }
    ?>
    
</body>
</html>