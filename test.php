<?php
    include 'Class/BaseDeCalcul.php';
    require 'siResultatSuperieur33.php';
    
    $prenoms = htmlspecialchars($_POST['prenoms']);
    $nomPere = htmlspecialchars($_POST['nomPere']);
    $nomMere = htmlspecialchars($_POST['nomMere']);

    $nomsTableau    = mb_strtolower($prenoms);
    $nomPere        = mb_strtolower($nomPere);
    $nomMere        = mb_strtolower($nomMere);

    $nomsTableau    = explode(" ",$nomsTableau);
    $nomPere        = explode(" ",$nomPere);
    $nomMere        = explode(" ",$nomMere);
    $nomsTableau    = array_merge($nomsTableau, $nomPere, $nomMere);
    var_dump($nomsTableau);
    echo '</br></br>';


    $nomSplit = implode("",$_POST);
    $nomSplit = htmlspecialchars($nomSplit);
    $nomSplit = mb_strtolower($nomSplit);
    $nomSplit = utf8_decode($nomSplit);
    $nomSplit = str_split($nomSplit);
    var_dump($nomSplit);
    echo '</br></br>';


    $resultat_pierreDeBase            = 0;
    $resultat_pierreDeSommet          = 0;
    $resultat_pierreDeVie             = 0;
    $resultat_pierreDappel            = 0;
    $resultat_pierreDePersonnalite    = 0;
    $resultat_pierreDexpression       = 0;
    $resultat_pierreDeTouche          = 0;
    $resultat_pierreDeVoeux           = 0;

    
    foreach($nomsTableau as $index){

        // 
        // PIERRE DE VOEUX // Somme de la premiÃ¨re voyelle des prÃ©noms et noms.
        // 
        
        $pierreDeVoeux_premiereVoyelle = true;
        
        for( $i=0; $i<strlen($index); $i++){
            foreach(BaseDeCalcul::$voyelles as $voyelle){
                if ($index[$i] == utf8_decode($voyelle[0])){
                    if($pierreDeVoeux_premiereVoyelle){
                        $resultat_pierreDeVoeux += $voyelle[1];
                        $pierreDeVoeux_premiereVoyelle = false;
                        break;
                    }
                }
            }  
            if($pierreDeVoeux_premiereVoyelle == false){
                break;
            }
        }
        
        // 
        // PIERRE DE BASE   // Somme de la premiÃ¨re lettre des prÃ©noms et des noms.
        // PIERRE DE SOMMET // Somme de la derniÃ¨re lettres des prÃ©noms et noms.
        // 

        $premiereLettre = 0;
        $derniereLettre = strlen($index)-1;

        foreach(BaseDeCalcul::$voyelles as $voyelle){
            
            if ($index[$premiereLettre] == utf8_decode($voyelle[0])){
                $resultat_pierreDeBase += $voyelle[1];
            }
            if ($index[$derniereLettre] == utf8_decode($voyelle[0])){
                $resultat_pierreDeSommet += $voyelle[1];
            }
        }
        foreach(BaseDeCalcul::$consonnes as $consonne){
            if ($index[$premiereLettre] == utf8_decode($consonne[0])){
                $resultat_pierreDeBase += $consonne[1];
            }
            if ($index[$derniereLettre] == utf8_decode($consonne[0])){
                $resultat_pierreDeSommet += $consonne[1];
            }
        }
    }

    $valeur_pierreDeBase        = $resultat_pierreDeBase;
    $valeur_pierreDeSommet      = $resultat_pierreDeSommet;
    siResultatSuperieur33($resultat_pierreDeBase);
    siResultatSuperieur33($resultat_pierreDeSommet);
    siResultatSuperieur33($resultat_pierreDeVoeux);

    
    // 
    // PIERRE D'APPEL // Somme des voyelles des noms et prÃ©noms.
    // 
    foreach($nomSplit as $nom){
        foreach(BaseDeCalcul::$voyelles as $voyelle){
            if ($nom == utf8_decode($voyelle[0])){
                $resultat_pierreDappel = $resultat_pierreDappel + $voyelle[1];
            }
        }
    }
    $valeur_pierreDappel            = $resultat_pierreDappel;
    siResultatSuperieur33($resultat_pierreDappel);

    // 
    // PIERRE DE PERSONNALITE
    // Somme des consonnes des noms et prénoms.
    // 
    foreach($nomSplit as $nom){
        foreach(BaseDeCalcul::$consonnes as $consonne){
            if ($nom == utf8_decode($consonne[0])){
                $resultat_pierreDePersonnalite += $consonne[1];
            }
        }
    }
    $valeur_pierreDePersonnalite    = $resultat_pierreDePersonnalite;
    siResultatSuperieur33($resultat_pierreDePersonnalite);

    // 
    // PIERRE D EXPRESSION
    // Somme de la pierre d'Appel et Personnalité (non réduite).
    // 
    $valeur_pierreDexpression       = $resultat_pierreDexpression;
    $resultat_pierreDexpression     = $valeur_pierreDappel + $valeur_pierreDePersonnalite;
    siResultatSuperieur33($resultat_pierreDexpression);
    
    // 
    // PIERRE DE TOUCHE
    // Somme de toutes les pierres sauf chemin de vie et voeux (non réduite).
    // 

    $resultat_pierreDeTouche    = $valeur_pierreDeBase
                                + $valeur_pierreDeSommet
                                + $valeur_pierreDappel
                                + $valeur_pierreDePersonnalite
                                + $valeur_pierreDexpression;
                            
                                if ($resultat_pierreDeTouche>33){
                                    $newResult = str_split($resultat_pierreDeTouche);
                                    $resultat_pierreDeTouche = 0;
                                    foreach($newResult as $newR){
                                        $resultat_pierreDeTouche += $newR;
                                    }    
                                }

    echo '</br>'.$resultat_pierreDeBase.'</br>';
    echo '</br>'.$resultat_pierreDeSommet.'</br>';
    echo '</br>'.$resultat_pierreDappel.'</br>';
    echo '</br>'.$resultat_pierreDePersonnalite.'</br>';
    echo '</br>'.$resultat_pierreDexpression.'</br>';
    echo '</br>'.$resultat_pierreDeTouche.'</br>';
    echo '</br>'.$resultat_pierreDeVoeux.'</br>';

    
    echo '</br>Pierre de Base = '           .BaseDeCalcul::$pierres[$resultat_pierreDeBase-1];
    echo '</br>Pierre de Sommet = '         .BaseDeCalcul::$pierres[$resultat_pierreDeSommet-1];
    // echo '</br>Pierre de Vie = '            .BaseDeCalcul::$pierres[$resultat_pierreDeVie-1];
    echo '</br>Pierre d Appel = '           .BaseDeCalcul::$pierres[$resultat_pierreDappel-1];
    echo '</br>Pierre de Personnalite = '   .BaseDeCalcul::$pierres[$resultat_pierreDePersonnalite-1];
    echo '</br>Pierre d Expression = '      .BaseDeCalcul::$pierres[$resultat_pierreDexpression-1];
    echo '</br>Pierre deTouche = '          .BaseDeCalcul::$pierres[$resultat_pierreDeTouche-1];
    echo '</br>Pierre de Voeux = '          .BaseDeCalcul::$pierres[$resultat_pierreDeVoeux-1];
    include './src/return.php';

