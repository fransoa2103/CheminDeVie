<?php session_start(); ?>

<?php

    // require_once '../Class/Bracelet.php';
    spl_autoload_register(function($class){
        require_once('../Class/'.$class.'.php');
    });

    
    $bracelet = new Bracelet($_POST);
    $_SESSION['user'] = [
        'prenoms' => $bracelet->prenoms,
        'nomPere' => $bracelet->nomPere,
        'nomMere' => $bracelet->nomMere,
        'birthday' => $bracelet->dateNaissance[2].$bracelet->dateNaissance[1].$bracelet->dateNaissance[0],
    ];
    
    echo 'Bonjour nous sommes le '.date('d/m/Y à H:i:s');
    echo '</br>Bienvenue '.$_SESSION['user']['prenoms'].' '.$_SESSION['user']['nomPere'].' '.$_SESSION['user']['nomMere'];
    echo '</br>Vous êtes né(e) le '.$_SESSION['user']['birthday'];
    echo '</br>Voici votre chemin de vie:';
    
    $x = "teste 2";
    for($i = 0; $i<count(BaseDeCalcul::$formules); $i++){
        echo '</br>'.BaseDeCalcul::$formules[$i][0].' >> '.BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1];
        $_SESSION['user']['formule'.$i]     =   BaseDeCalcul::$formules[$i][0];
        $_SESSION['user']['resultat'.$i]    =   BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][1]-1];
    }

    include 'lien_retour_index.php';
?>

</br><a href="generateur_PDF.php">generer pdf</a>;
</br><a href="test2.php">test 2</a>;

