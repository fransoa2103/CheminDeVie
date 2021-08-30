
<?php
    require_once '../Class/User.php';
    echo 'Bonjour nous sommes le '.date('d/m/Y à H:i:s').'</br>';
    
    $new = new User($_POST);
    echo '</br>Voici le résultat de votre chemin de vie, '.$_POST['prenoms'].' '.$_POST['nomPere'].'.';
    echo '</br>Le nom de jeune fille de votre mère est, '.$_POST['nomMere'].'.';
    echo '</br>Vous êtes né(e) le: '.$new->dateNaissance[2].'-'.$new->dateNaissance[1].'-'.$new->dateNaissance[0].'</br>';
    echo '</br>Si les informations ci-dessus sont inexactes, ce calcul est bien evidemment faussé!';

    echo '<h3>PIERRE DE BASE >> '.$new->result_pierreDeBase.'</h3>';

    
    echo '<h3>PIERRE DE SOMMET >> '.$new->result_pierreDeSommet.'</h3>';
    
    // La pierre chemin de vie est la somme de la date de naissance.
    echo '<h3>PIERRE DE CHEMIN DE VIE >> '.$new->result_pierreDeVie.'</h3>';
    
    // Somme des voyelles des noms et prénoms.
    echo '<h3>PIERRE D\'APPEL >> '.$new->result_pierreDappel.'</h3>';
    
    // La pierre de personnalité est la somme des consonnes des noms et prénoms.
    echo '<h3>PIERRE DE PERSONNALITE >> '.$new->result_pierreDePersonnalite.'</h3>';
    
    // La pierre d’expression est la somme de la pierre d’appel et personnalité (non réduite).
    echo '<h3>PIERRE D\'EXPRESSION >> '.$new->result_pierreDexpression.'</h3>';

    // La pierre de touche est la somme de toutes les pierres sauf chemin de vie et vœux (non réduite)
    echo '<h3>PIERRE DE TOUCHE >> '.$new->result_pierreDeTouche.'</h3>';

    // La pierre de vœux est la somme de la première voyelle des prénoms et noms.
    echo '<h3>PIERRE DE VOEUX >> '.$new->result_pierreDeVoeux.'</h3>';


    include 'return.php';
?>