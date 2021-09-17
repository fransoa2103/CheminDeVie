<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CHEMIN DE VIE PDF</title>
        <style><?php include 'C:\xampp\htdocs\CheminDeVie\style_PDF.css' ?></style>
    </head>
    <body>
        <!-- ENTETE DU DOCUMENT -->
        <div class = "entete">
            <?php
                echo
                '<p>
                    Bonjour '.$_SESSION['user']['prenoms'].' / '.$_SESSION['user']['nomPere'].' / '.$_SESSION['user']['nomMere'].'
                    Vous êtes né(e) le '.$_SESSION['user']['birthday'].'
                </p>';
            ?>
            <h1>VOICI VOTRE CHEMIN DE VIE</h1>
        </div>

        <!-- RESULSTAT DU CHEMIN DE DE VIE -->
        <?php
        for($i = 0; $i<count(BaseDeCalcul::$formules); $i++ ){
        echo
            '<table style="font-size: 0.8rem;">'.
                '<tr style = "width: 100%">'.
                    '<td style ="width: 30%;">'.
                        '<div class = "fond_couleur_pierre" style=" margin: 0 auto; background-color:'.$_SESSION['user']['couleur'.$i].'">'.
                        '<p class = "firstLetter">'.($i+1).'</p>'.
                        '<img class = "image_position_pierre" src = "./images/'.$_SESSION['user']['nom_pierre'.$i].'.png" alt = "" >'.
                    '</td>'.
                    '<td>'.
                        '<p>'.$_SESSION['user']['definition_formule'.$i].'</p>'.
                        '<p style = "font-weight: bold; font-size: 1rem;">Votre pierre de '.$_SESSION['user']['nom_formule'.$i].' est '.$_SESSION['user']['article_pierre'.$i].$_SESSION['user']['nom_pierre'.$i].'.</p>'.
                        '<p>'.$_SESSION['user']['definition_1_pierre'.$i].' '.$_SESSION['user']['definition_2_pierre'.$i].'</p>'.
                    '</td>'.
                '</tr>'.
            '</table>';
        }
    ?>
    </body>
</html>
