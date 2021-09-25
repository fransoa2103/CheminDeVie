<!DOCTYPE html>
<html lang="fr">
    <?php include 'components/html_head.php'; ?>
    <style><?php include './CheminDeVie/style_PDF.css' ?></style>
    <body>

        <!------------------------>
        <!-- ENTETE DU DOCUMENT -->
        <!------------------------>
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

        <!----------------------------------->
        <!-- RESULTATS DU CHEMIN DE DE VIE -->
        <!----------------------------------->
        <?php
            for($i = 0; $i<count(BaseDeCalcul::$formules); $i++ ){
                echo
                    '<table style = "margin: 25px 0px;">'.
                        '<tr>'.
                            '<td style = "width: 30%">'.
                                '<div class = "fond_couleur_pierre" style=" margin: 0 auto; background-color:'.$_SESSION['user']['couleur'.$i].'">'.
                                '<span class = "firstLetter">'.($i+1).'</span>'.
                                '<img class = "image_position_pierre" src = "./images/'.$_SESSION['user']['nom_pierre'.$i].'.png" alt = "" >'.
                            '</td>'.
                            '<td style = "width: 70%">'.
                                '<p>'.$_SESSION['user']['definition_formule'.$i].'</p>'.
                                '<p style = "font-weight: bold; font-size: 1rem;">Votre pierre de '.$_SESSION['user']['nom_formule'.$i].' est '.$_SESSION['user']['article_pierre'.$i].$_SESSION['user']['nom_pierre'.$i].'.</p>'.
                                '<p>'.$_SESSION['user']['definition_1_pierre'.$i].' '.$_SESSION['user']['definition_2_pierre'.$i].'</p>'.
                            '</td>'.
                        '</tr>'.
                    '</table>'.
                '<hr>';
            }
        ?>
    </body>
</html>
