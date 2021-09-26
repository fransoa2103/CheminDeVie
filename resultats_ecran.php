<?php

    // require_once './components/controle_session.php';

    session_start();
    // spl_autoload_register(function($class){
    //     require_once('./Class/'.$class.'.php');
    // });
    include './Class/BaseDeCalcul.php';
    include './Class/Bracelet.php';
    
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
    <?php include './components/html_head.php'; ?>
    <body>
        <h1>Chemin De Vie</h1>
        <div class="entete">
            <p>Bonjour <?=$_SESSION['user']['prenoms'].' / '.$_SESSION['user']['nomPere'].' / '.$_SESSION['user']['nomMere']?></p>
            <p>'Votre date de naissance est le <?=$_SESSION['user']['birthday']?></p>
            <p>et voici votre chemin de vie.</p>
        </div>
        <div class="menu_liens">
            <a href="index.php">Retour à l'accueil</a>
        </div>        
        <?php
            $i = 0;
            foreach(BaseDeCalcul::$formules as $formule){
                $_SESSION['user']['nom_formule'.$i]         = $formule[0];
                $_SESSION['user']['resultat_formule'.$i]    = $formule[1];
                $_SESSION['user']['definition_formule'.$i]  = $formule[2];
                
                foreach(BaseDeCalcul::$pierres as $key=>$pierre){
                    if($key == $formule[1]){
                        $_SESSION['user']['nom_pierre'.$i]          = $pierre[0];
                        $_SESSION['user']['article_pierre'.$i]      = $pierre[1];
                        $_SESSION['user']['definition_1_pierre'.$i] = $pierre[2];
                        $_SESSION['user']['definition_2_pierre'.$i] = $pierre[3];
                        $_SESSION['user']['couleur'.$i]             = $pierre[4];
                        ?>
                        <section class="grid_resultat">
                            <div class = "fond_couleur_pierre" style="background-color:<?=$_SESSION['user']['couleur'.$i]?>">
                                <p class = "firstLetter"><?=($i+1)?></p>
                                <img class = "image_position_pierre" src = "./images/<?=$_SESSION['user']['nom_pierre'.$i]?>.png" alt = "">
                            </div>
                            <div>
                                <p><?=$_SESSION['user']['definition_formule'.$i]?></p>
                                <p>Votre pierre de <?=$_SESSION['user']['nom_formule'.$i].' est '.$_SESSION['user']['article_pierre'.$i].$_SESSION['user']['nom_pierre'.$i]?></p>
                                <p><?=$_SESSION['user']['definition_1_pierre'.$i].' '.$_SESSION['user']['definition_2_pierre'.$i]?></p>
                            </div>
                        </section>
                        <?php
                        break;
                    }
                }
                $i++;
            }
        ?>
    </body>
</html>