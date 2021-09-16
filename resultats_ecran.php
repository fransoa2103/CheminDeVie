<?php
    session_start();
    // require_once '../Class/Bracelet.php';
    spl_autoload_register(function($class){
        require_once('./Class/'.$class.'.php');
    });

    $bracelet = new Bracelet($_POST);
    $_SESSION['user'] = [
        'prenoms' => mb_strtolower($bracelet->prenoms),
        'nomPere' => mb_strtolower($bracelet->nomPere),
        'nomMere' => mb_strtolower($bracelet->nomMere),
        'birthday' => $bracelet->dateNaissance[2].'/'.$bracelet->dateNaissance[1].'/'.$bracelet->dateNaissance[0]
    ];
?>

<!DOCTYPE html>
<html lang="fr">
    <?php include ('asset/html_head.php'); ?>
    <body>
        <h1>Chemin De Vie</h1>
        <div class="entete">
            <?php
                echo '</p>Bonjour '.$_SESSION['user']['prenoms'].' '.$_SESSION['user']['nomPere'].' '.$_SESSION['user']['nomMere'].'</p>';
                echo '</p>Vous êtes né(e) le '.$_SESSION['user']['birthday'].'</p>';
                echo '</p>et voici votre chemin de vie:'.'</p>';
            ?>
        </div>
        <?php
            for($i = 0; $i<count(BaseDeCalcul::$formules); $i++){
                $_SESSION['user']['nom_formule'.$i]         = BaseDeCalcul::$formules[$i][0];
                $_SESSION['user']['definition_formule'.$i]  = BaseDeCalcul::$formules[$i][2];
                $_SESSION['user']['nom_pierre'.$i]          = BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]][0];
                $_SESSION['user']['article_pierre'.$i]      = BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]][1];
                $_SESSION['user']['definition_1_pierre'.$i] = BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]][2];
                $_SESSION['user']['definition_2_pierre'.$i] = BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]][3];
                $_SESSION['user']['couleur'.$i]             = BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]][4];
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
            include 'asset/lien_retour_index.php';
        ?>
        <a href="asset/generateur_PDF.php">Générer votre chemin de vie au format PDF</a>;
    </body>
</html>