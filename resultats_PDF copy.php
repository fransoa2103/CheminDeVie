<!DOCTYPE html>
<html lang="fr">
    <meta charset="UTF-8">
    <?php include ('components/html_head.php'); ?>
    <style link rel="stylesheet" href="style.css"></style>
    <body>
        <div style = "width: 100%; padding: 1%; margin: 1% 0 5% 0; border: 1px black solid; text-align: center;">
            <h1 style = " width: 100%; padding: 1%; text-align: center; font-size: 2rem;">VOICI VOTRE CHEMIN DE VIE</h1>
            <?php
                echo '</p>Bonjour '.$_SESSION['user']['prenoms'].' '.$_SESSION['user']['nomPere'].' '.$_SESSION['user']['nomMere'].'</p>';
                echo '</p><br>Vous êtes né(e) le '.$_SESSION['user']['birthday'].'</p>';
            ?>
        </div>
        <?php
        for($i = 0; $i<count(BaseDeCalcul::$formules); $i++ ){
           echo
            '<div>'.
                '<div style="width: 100px; background-color:'.$_SESSION['user']['couleur'.$i].'">'.
                    '<p style = "font-size: 4rem; padding: 10px 0px 0px 10px;">'.($i+1).'</p>'.
                    '<img style = "width: 50px; position: relative; transform: translate(35%,-25%);" src = "../images/'.$_SESSION['user']['nom_pierre'.$i].'.png" alt = "" >'.
                '</div>'.
                '<div>'.
                    '<p>'.$_SESSION['user']['definition_formule'.$i].'</p>'.
                    '<p style = "font-weight: bold; font-size: 1rem;">Votre pierre de '.$_SESSION['user']['nom_formule'.$i].' est '.$_SESSION['user']['article_pierre'.$i].$_SESSION['user']['nom_pierre'.$i].'.</p>'.
                    '<p>'.$_SESSION['user']['definition_1_pierre'.$i].' '.$_SESSION['user']['definition_2_pierre'.$i].'</p>'.
                '</div>'.
            '</div>';
        }
        ?>
    </body> 
</html>