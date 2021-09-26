<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HELLO WORLD</h1>
    <?php
        for($i = 0; $i<count(BaseDeCalcul::$formules); $i++){
            echo '<section class="grid_resultat">';
                $_SESSION['user']['formule'.$i]     =   BaseDeCalcul::$formules[$i][0];
                $_SESSION['user']['resultat'.$i]    =   BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1][0];
                $img = './images/'.$_SESSION['user']['resultat'.$i].'.png';
                $couleur = BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1][4];
                echo '<div>';
                    echo '<div class = "fond_couleur_pierre" style="background-color:'.BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1][4].'">';
                        echo '<p class = "firstLetter">'.($i+1).'</p>';
                            echo '<img class = "image_position_pierre" src = '.$img.' alt = "'.BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1][0].'" >';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div>'.BaseDeCalcul::$formules[$i][2].'</div>';
                echo '<div>Votre pierre de '.BaseDeCalcul::$formules[$i][0].' est '.BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1][1].BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1][0].'.</div>';
                echo '<div>';
                    echo '<p>'.BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1][2].' '.BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1][3].'</p>';
                echo '</div>';
            echo '</section>';
        }
    ?>
</body>
</html>