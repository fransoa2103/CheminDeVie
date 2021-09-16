<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">
<?php include ('asset/html_head.php'); ?>

    <body>
        <h1>Chemin De Vie</h1>
        <?php
            echo '</p>Bonjour '.$_SESSION['user']['prenoms'].' '.$_SESSION['user']['nomPere'].' '.$_SESSION['user']['nomMere'].'</p>';
            echo '</p>Vous êtes né(e) le '.$_SESSION['user']['birthday'].'</p>';
            echo '</p>et voici votre chemin de vie:'.'</p>';
            for($i = 0; $i<count(BaseDeCalcul::$formules); $i++){
                echo '<section class="grid_resultat">';
                    echo '<div>';
                        echo '<div class = "fond_couleur_pierre" style="background-color:'.$_SESSION['user']['couleur'.$i].'">';
                            echo '<p class = "firstLetter">'.($i+1).'</p>';
                                echo '<img class = "image_position_pierre" src = "./images/'.$_SESSION['user']['nom_pierre'.$i].'.png" alt = "" >';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div>'.$_SESSION['user']['definition_formule'.$i].'</div>';
                    echo '<div>Votre pierre de '.$_SESSION['user']['nom_formule'.$i].' est '.$_SESSION['user']['article_pierre'.$i].$_SESSION['user']['nom_pierre'.$i].'.</div>';
                    echo '<div>';
                        echo '<p>'.$_SESSION['user']['definition_1_pierre'.$i].' '.$_SESSION['user']['definition_2_pierre'.$i].'</p>';
                    echo '</div>';
                echo '</section>';
            }
            ?>
    </body> 
    </html>
    <?php
    // echo '<section style = "display: grid; grid-template-columns: 1fr; grid-template-rows: repeat(auto, 1fr); grid-column-gap: 5px; grid-row-gap: 5px;">';
    //     echo '<div>';
    //         echo '<div style = "width: 150px; height: 150px; background-color:'.$_SESSION['user']['couleur'.$i].'">';
    //             echo '<p style = "font-size: 4rem; color: var(--color_2); padding: 10px 0px 0px 10px;">'.($i+1).'</p>';
    //                 echo '<img style = "width: 150px; position: relative; transform: translate(35%,-25%);" src = "./images/'.$_SESSION['user']['nom_pierre'.$i].'.png" alt = "" >';
    //             echo '</div>';
    //         echo '</div>';
    //     echo '</div>';
    //     echo '<div style = "margin-top: 5%;">'.$_SESSION['user']['definition_formule'.$i].'</div>';
    //     echo '<div style = "font-weight: bold; font-size: calc(1*var(--texte_size));">Votre pierre de '.$_SESSION['user']['nom_formule'.$i].' est '.$_SESSION['user']['article_pierre'.$i].$_SESSION['user']['nom_pierre'.$i].'.</div>';
    //     echo '<div style = "margin-bottom: 5%;">';
    //         echo '<p>'.$_SESSION['user']['definition_1_pierre'.$i].' '.$_SESSION['user']['definition_2_pierre'.$i].'</p>';
    //     echo '</div>';
    // echo '</section>';