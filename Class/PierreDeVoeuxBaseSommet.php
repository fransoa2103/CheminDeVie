<?php
// 
// 1. PIERRE DE VOEUX  // Somme de la première voyelle des prénoms et noms.
// 2. PIERRE DE BASE   // Somme de la première lettre  des prénoms et noms.
// 3. PIERRE DE SOMMET // Somme de la dernière lettres des prénoms et noms.
// 
class PierreDeVoeuxBaseSommet extends BasedeCalcul{
    public static function pierreDeVoeuxBaseSommet(
            $nomsTableau,
            $resultat_pierreDeVoeux,
            $resultat_pierreDeBase,
            $valeur_pierreDeBase,
            $resultat_pierreDeSommet,
            $valeur_pierreDeSommet
    ){
        foreach($nomsTableau as $index)
        {
            // 
            // 1. PIERRE DE VOEUX  // Somme de la première voyelle des prénoms et noms.
            // 
            $pierreDeVoeux_premiereVoyelle = true;
            for( $i=0; $i<strlen($index); $i++)
            {
                foreach(BaseDeCalcul::$voyelles as $voyelle)
                {
                    if ($index[$i] == utf8_decode($voyelle[0]))
                    {
                        if($pierreDeVoeux_premiereVoyelle)
                        {
                            $resultat_pierreDeVoeux += $voyelle[1];
                            $pierreDeVoeux_premiereVoyelle = false;
                            break;
                        }
                    }
                }  
                if (!$pierreDeVoeux_premiereVoyelle)
                {
                    break;
                }
            }
        
            // 
            // 2. PIERRE DE BASE   // Somme de la première lettre  des prénoms et noms.
            // 
            $premiereLettre = 0;

            // 
            // 3. PIERRE DE SOMMET // Somme de la dernière lettres des prénoms et noms.
            // 
            $derniereLettre = strlen($index)-1;

            foreach(BaseDeCalcul::$voyelles as $voyelle)
            {
                if ($index[$premiereLettre] == utf8_decode($voyelle[0])){
                    $resultat_pierreDeBase += $voyelle[1];
                }
                if ($index[$derniereLettre] == utf8_decode($voyelle[0])){
                    $resultat_pierreDeSommet += $voyelle[1];
                }
            }
            foreach(BaseDeCalcul::$consonnes as $consonne)
            {
                if ($index[$premiereLettre] == utf8_decode($consonne[0])){
                    $resultat_pierreDeBase += $consonne[1];
                }
                if ($index[$derniereLettre] == utf8_decode($consonne[0])){
                    $resultat_pierreDeSommet += $consonne[1];
                }
            }
            $valeur_pierreDeBase    == $resultat_pierreDeBase;
            $valeur_pierreDeSommet  == $resultat_pierreDeSommet;
            
            siResultatSuperieur33($resultat_pierreDeBase);
            siResultatSuperieur33($resultat_pierreDeSommet);
            siResultatSuperieur33($resultat_pierreDeVoeux);
        }
    }
}