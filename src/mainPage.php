
<?php
    require_once '../Class/Bracelet.php';
    echo 'Bonjour nous sommes le '.date('d/m/Y à H:i:s').'</br>';
    
    $bracelet = new Bracelet($_POST);
    
    echo '</br>Voici le résultat de votre chemin de vie, '.$_POST['prenoms'].' '.$_POST['nomPere'].'.';
    echo '</br>Le nom de jeune fille de votre mère est, '.$_POST['nomMere'].'.';
    echo '</br>Vous êtes né(e) le: '.$_POST['dateNaissance'][1].'-'.$bracelet->dateNaissance[1].'-'.$bracelet->dateNaissance[0].'</br>';
    echo '</br>Si les informations ci-dessus sont inexactes, ce calcul est bien evidemment faussé!';
    
    echo '</br>Pierre de Base = '           .BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeBase-1];
    echo '</br>Pierre de Sommet = '         .BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeSommet-1];
    // echo '</br>Pierre de Vie = '            .BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeVie-1];
    echo '</br>Pierre d Appel = '           .BaseDeCalcul::$pierres[$bracelet->resultat_pierreDappel-1];
    echo '</br>Pierre de Personnalite = '   .BaseDeCalcul::$pierres[$bracelet->resultat_pierreDePersonnalite-1];
    echo '</br>Pierre d Expression = '      .BaseDeCalcul::$pierres[$bracelet->resultat_pierreDexpression-1];
    echo '</br>Pierre deTouche = '          .BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeTouche-1];
    echo '</br>Pierre de Voeux = '          .BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeVoeux-1];
    
    include 'return.php';

?>