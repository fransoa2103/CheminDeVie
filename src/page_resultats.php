
<?php
    require_once '../Class/Bracelet.php';

    echo 'Bonjour nous sommes le '.date('d/m/Y à H:i:s').'</br>';
    
    $bracelet = new Bracelet($_POST);
    
    echo '</br>'.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeBase-1]         .' > Pierre de Base';
    echo '</br>'.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeSommet-1]       .' > Pierre de Sommet';
    echo '</br>'.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeVie-1]          .' > Pierre de Vie';
    echo '</br>'.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDappel-1]         .' > Pierre d Appel';
    echo '</br>'.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDePersonnalite-1] .' > Pierre de Personnalite';
    echo '</br>'.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDexpression-1]    .' > Pierre d Expression';
    echo '</br>'.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeTouche-1]       .' > Pierre deTouche';
    echo '</br>'.BaseDeCalcul::$pierres[$bracelet->resultat_pierreDeVoeux-1]        .' > Pierre de Voeux';
    
    include 'lien_retour_index.php';

?>