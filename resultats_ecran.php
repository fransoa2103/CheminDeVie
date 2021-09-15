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
            include 'asset/lien_retour_index.php';
        ?>
        <a href="asset/generateur_PDF.php">Générer votre chemin de vie au format PDF</a>;
    </body>
</html>