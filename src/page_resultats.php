
<?php
    require_once '../Class/Bracelet.php';

    echo 'Bonjour nous sommes le '.date('d/m/Y à H:i:s').'</br>';
    $bracelet = new Bracelet($_POST);

    // echo 'Voici votre chemin de vie '.$bracelet->noms[0].'</br>';
    echo '</n>Voici votre chemin de vie '
        .$bracelet->prenoms.' '
        .$bracelet->nomPere.' '
        .$bracelet->nomMere.'</br>';

    for($i = 0; $i<count(BaseDeCalcul::$formules); $i++){
        echo '</br>'.BaseDeCalcul::$formules[$i][0].' >> '.BaseDeCalcul::$pierres[BaseDeCalcul::$formules[$i][2]-1];
    }

    include 'lien_retour_index.php';

?>