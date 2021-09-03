<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            echo 'Bonjour nous sommes le '.date('d/m/Y à H:i:s').'</br>';
            echo '</n>Voici votre chemin de vie '
            .$_SESSION['prenoms'].' '
            .$_SESSION['nomPere'].' '
            .$_SESSION['nomMere'].'</br>';
            echo '</br>'.BaseDeCalcul::$formules[0][0].' >> '.BaseDeCalcul::$pierres[BaseDeCalcul::$formules[0][1]];
    // for($i = 0; $i<count(BaseDeCalcul::$formules); $i++){
    //     echo '</br>'.BaseDeCalcul::$formules[$i][0].' >> '.BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1];
    // }
        ?>
    </body>
</html>