<?php
require_once 'BaseDeCalcul.php';
class Bracelet extends BaseDeCalcul {

    public function __construct($data){

        $this->dateNaissance    = htmlspecialchars($data['dateNaissance']);
        $this->dateNaissance    = explode("-",$this->dateNaissance);
        
        $this->nomPere          = htmlspecialchars($data['nomPere']);
        $this->nomPere          = mb_strtolower($this->nomPere);
        $this->nomPere          = explode(" ",$this->nomPere);
        
        $this->nomMere          = htmlspecialchars($data['nomMere']);
        $this->nomMere          = mb_strtolower($this->nomMere);
        $this->nomMere          = explode(" ",$this->nomMere);
        
        $this->nomsTableau      = htmlspecialchars($data['prenoms']);
        $this->nomsTableau      = mb_strtolower($this->nomsTableau);
        $this->nomsTableau      = explode(" ",$this->nomsTableau);
        $this->nomsTableau      = array_merge($this->nomsTableau, $this->nomPere, $this->nomMere);
    
        $this->nomSplit         = implode("",$this->nomsTableau);
        $this->nomSplit         = htmlspecialchars($this->nomSplit);
        $this->nomSplit         = mb_strtolower($this->nomSplit);
        $this->nomSplit         = utf8_decode($this->nomSplit);
        $this->nomSplit         = str_split($this->nomSplit);

        // var_dump($this->nomsTableau);
        // var_dump($this->nomSplit);
        // var_dump($this->dateNaissance);
    
        $this->resultat_pierreDeBase            = 0;
        $this->resultat_pierreDeSommet          = 0;
        $this->resultat_pierreDeVie             = 0;
        $this->resultat_pierreDappel            = 0;
        $this->resultat_pierreDePersonnalite    = 0;
        $this->resultat_pierreDexpression       = 0;
        $this->resultat_pierreDeTouche          = 0;
        $this->resultat_pierreDeVoeux           = 0;
        $this->resultat_nouveauCalcul           = 0;

        $this->pierreDeVoeuxBaseSommet();
        $this->pierreDappel();
        $this->pierreDePersonnalite();
        $this->pierreDexpression();
        $this->pierreDeTouche();
        $this->pierreDeVie();
    }

        
        public function pierreDeVoeuxBaseSommet(){
            
            
            // 1. PIERRE DE VOEUX == Somme de la première voyelle des prénoms et noms.
            // 2. PIERRE DE BASE   // Somme de la première lettre  des prénoms et noms.
            // 3. PIERRE DE SOMMET // Somme de la dernière lettres des prénoms et noms.
            foreach($this->nomsTableau as $index){
                
                $pierreDeVoeux_premiereVoyelle = true;
                foreach($this->nomSplit as $nom){
                    foreach(BaseDeCalcul::$voyelles as $voyelle){
                        if ($nom == utf8_decode($voyelle[0]) && $pierreDeVoeux_premiereVoyelle){
                                $this->resultat_pierreDeVoeux += $voyelle[1];
                                $pierreDeVoeux_premiereVoyelle = false;
                                break;
                        }
                    }
                }
                
                $premiereLettre = 0;
                $derniereLettre = strlen($index)-1;
                
                foreach(BaseDeCalcul::$voyelles as $voyelle)
                {
                    if ($index[$premiereLettre] == utf8_decode($voyelle[0])){
                        $this->resultat_pierreDeBase += $voyelle[1];
                    }
                    if ($index[$derniereLettre] == utf8_decode($voyelle[0])){
                        $this->resultat_pierreDeSommet += $voyelle[1];
                    }
                }
                foreach(BaseDeCalcul::$consonnes as $consonne)
                {
                    if ($index[$premiereLettre] == utf8_decode($consonne[0])){
                        $this->resultat_pierreDeBase += $consonne[1];
                    }
                    if ($index[$derniereLettre] == utf8_decode($consonne[0])){
                        $this->resultat_pierreDeSommet += $consonne[1];
                    }
                }
            }
            
            $this->siResultatSuperieur33($this->resultat_pierreDeVoeux);
            $this->resultat_pierreDeVoeux = $this->resultat_nouveauCalcul;

            $this->valeur_pierreDeBase    = $this->resultat_pierreDeBase;
            $this->valeur_pierreDeSommet  = $this->resultat_pierreDeSommet;
            
            $this->siResultatSuperieur33($this->resultat_pierreDeBase);
            $this->resultat_pierreDeBase = $this->resultat_nouveauCalcul;
            
            $this->siResultatSuperieur33($this->resultat_pierreDeSommet);
            $this->resultat_pierreDeSommet = $this->resultat_nouveauCalcul;
            
        }
        
    // 
    // PIERRE D'APPEL // Somme des voyelles des noms et prénoms.
    // 
    public function pierreDappel()
    {
        foreach($this->nomSplit as $nom){
            foreach(BaseDeCalcul::$voyelles as $voyelle){
                if ($nom == utf8_decode($voyelle[0])){
                    $this->resultat_pierreDappel += $voyelle[1];
                }
            }
        }
        $this->valeur_pierreDappel = $this->resultat_pierreDappel;

        $this->siResultatSuperieur33($this->resultat_pierreDappel);
        $this->resultat_pierreDappel = $this->resultat_nouveauCalcul;

    }       

    // PIERRE DE PERSONNALITE
    // Somme des consonnes des noms et prénoms.
    
    public function pierreDePersonnalite()
    {
        foreach($this->nomSplit as $nom){
            foreach(BaseDeCalcul::$consonnes as $consonne){
                if ($nom == utf8_decode($consonne[0])){
                    $this->resultat_pierreDePersonnalite += $consonne[1];
                }
            }
        }
        
        $this->valeur_pierreDePersonnalite = $this->resultat_pierreDePersonnalite;

        $this->siResultatSuperieur33($this->resultat_pierreDePersonnalite);
        $this->resultat_pierreDePersonnalite = $this->resultat_nouveauCalcul;

    }
  
    // PIERRE D EXPRESSION
    // Somme de la pierre d'Appel et Personnalité (non réduite).
    
    public function pierreDexpression()
    {
        
        $this->resultat_pierreDexpression  = $this->valeur_pierreDappel + $this->valeur_pierreDePersonnalite;
        $this->valeur_pierreDexpression    = $this->resultat_pierreDexpression;

        $this->siResultatSuperieur33($this->resultat_pierreDexpression);
        $this->resultat_pierreDexpression = $this->resultat_nouveauCalcul;
    }

    // PIERRE DE TOUCHE
    // Somme de toutes les pierres sauf chemin de vie et voeux (non réduite).
    
    public function pierreDeTouche(){
        $this->resultat_pierreDeTouche  = $this->valeur_pierreDeBase
                                        + $this->valeur_pierreDeSommet
                                        + $this->valeur_pierreDappel
                                        + $this->valeur_pierreDePersonnalite
                                        + $this->valeur_pierreDexpression;
        $this->siResultatSuperieur33($this->resultat_pierreDeTouche);
        $this->resultat_pierreDeTouche = $this->resultat_nouveauCalcul;
    }

    // 
    // PIERRE DE CHEMIN DE VIE est la somme de la date de naissance
    // 
    public function pierreDeVie(){
        foreach($this->dateNaissance as $date){
            $this->resultat_pierreDeVie += floatval($date); // floatval retourne la valeur decimale ex: 1969+03+21 
        }
        $this->siResultatSuperieur33($this->resultat_pierreDeVie);
        $this->resultat_pierreDeVie = $this->resultat_nouveauCalcul;
    }

    // 
    // FUNCTION RETURN RESULTAT si les sommes trouvées sont supérieures à 33 = nombre de pierre max
    // 
    function siResultatSuperieur33($resultat){
        
        $this->resultat_nouveauCalcul = $resultat;

        if ($resultat>33){
            $nouveauResultat = str_split($resultat);
            $this->resultat_nouveauCalcul = 0;
            foreach($nouveauResultat as $index){
                $this->resultat_nouveauCalcul += $index;
            }    
        }

        return($this->resultat_nouveauCalcul);
    }
}
