<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <div style =    "background-image: url('../images/quartz-rose.png');
                        width: 100%; height : 100px;
                        background-repeat: no-repeat ;">
            <h1 style="text-align: center;">CHEMIN DE VIE<h1>
        </div>
            
        <?php
            echo '<h1>'.$_SESSION['user']['prenoms'].'.</h1>';
            echo '<p> Le nom de naissance de votre père est: '.$_SESSION['user']['nomPere'].'.</p>';
            echo '<p> Le nom de naissance de votre mère est: '.$_SESSION['user']['nomMere'].'.</p>';
            echo '<p> Vous est né(e) le '.$_SESSION['user']['birthday'].'</p>';
            echo '<p> Et voici votre chemin de Vie:'.'</p>';
            for($i = 0; $i<8; $i++){
                $img = '../images/'.$_SESSION['user']['resultat'.$i].'.png';
                ?>
                    <div>
                        <?php
                            echo '<img src='.$img.' alt="" srcset="" width="100">';
                            echo $_SESSION['user']['formule'.$i].' > '.$_SESSION['user']['resultat'.$i].'</br>';
                        ?>
                    </div>
                <?php
            }
        ?>
    
</body>
</html>