<?php
    session_start();
    // require_once '../Class/Bracelet.php';
    spl_autoload_register(function($class){
        require_once('../Class/'.$class.'.php');
    });

    $bracelet = new Bracelet($_POST);
    $_SESSION['user'] = [
        'prenoms' => $bracelet->prenoms,
        'nomPere' => $bracelet->nomPere,
        'nomMere' => $bracelet->nomMere,
        'birthday' => $bracelet->dateNaissance[2].'/'.$bracelet->dateNaissance[1].'/'.$bracelet->dateNaissance[0]
    ];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style = "text-align: center; width: 50%; margin: 0 auto;">
        <h1 style="text-align: center; color: black;">CHEMIN DE VIE</h1>
        <?php
            echo 'Bonjour nous sommes le '.date('d/m/Y à H:i:s');
            echo '</br>Bienvenue '.$_SESSION['user']['prenoms'].' '.$_SESSION['user']['nomPere'].' '.$_SESSION['user']['nomMere'];
            echo '</br>Vous êtes né(e) le '.$_SESSION['user']['birthday'];
            echo '</br>Voici votre chemin de vie:';
            
            for($i = 0; $i<count(BaseDeCalcul::$formules); $i++){
                $_SESSION['user']['formule'.$i]     =   BaseDeCalcul::$formules[$i][0];
                $_SESSION['user']['resultat'.$i]    =   BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1];
                $img = '../images/'.$_SESSION['user']['resultat'.$i].'.png';
                ?><div style= "display: flex; justify-content: center; margin-top: 10px; flex-wrap: wrap;">
                    <div style = "line-height: 100px;">
                        <?php
                            echo BaseDeCalcul::$formules[$i][0].' >> '.BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1];
                        ?>
                    </div>
                    <div>
                        <?php
                            echo '<img src='.$img.' alt="" srcset="" width="150">';
                        ?>
                    </div>
                </div><?php
            }
        ?>
        </br><a href="generateur_PDF.php">generer pdf</a>;
    </div>
</body>
</html>



