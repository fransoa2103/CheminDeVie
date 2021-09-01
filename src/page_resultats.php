
<?php
    require_once '../Class/Bracelet.php';

    echo 'Bonjour nous sommes le '.date('d/m/Y à H:i:s').'</br>';
    $bracelet = new Bracelet($_POST);

    // echo 'Voici votre chemin de vie '.$bracelet->noms[0].'</br>';
    echo 'Voici votre chemin de vie '.$bracelet->tab_nomsPrenoms[2].'</br>';
    // var_dump($bracelet->noms);
    
    echo '</br>Pierre de Base > '.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeBase-1];
    echo '</br>Pierre de Sommmet > '.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeSommet-1];
    echo '</br>Pierre de Vie > '.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeVie-1];
    echo '</br>Pierre d Appel > '.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDappel-1];
    echo '</br>Pierre de Personne > '.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDePersonnalite-1];
    echo '</br>Pierre d Expression > '.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDexpression-1];
    echo '</br>Pierre deTouche > '.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeTouche-1];
    echo '</br>Pierre de Voeux > '.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeVoeux-1];
    
    include 'lien_retour_index.php';

?>