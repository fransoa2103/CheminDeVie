<?php
require 'siResultatSuperieur33.php';
require_once 'BaseDeCalcul.php';
require_once 'PierreDeVoeuxBaseSommet.php';
class Bracelet extends BaseDeCalcul {
    
    public function __construct($data)
    {
        $this->prenoms          = htmlspecialchars($data['prenoms']);
        $this->nomPere          = htmlspecialchars($data['nomPere']);
        $this->nomMere          = htmlspecialchars($data['nomMere']);
        $this->dateNaissance    = htmlspecialchars($data['dateNaissance']);
    
        $this->nomsTableau      = mb_strtolower($this->prenoms);
        $this->nomPere          = mb_strtolower($this->nomPere);
        $this->nomMere          = mb_strtolower($this->nomMere);
    
        $this->nomsTableau      = explode(" ",$this->nomsTableau);
        $this->nomPere          = explode(" ",$this->nomPere);
        $this->nomMere          = explode(" ",$this->nomMere);
        $this->nomsTableau      = array_merge($this->nomsTableau, $this->nomPere, $this->nomMere);
    
        $this->nomSplit         = implode("",$data);
        $this->nomSplit         = htmlspecialchars($this->nomSplit);
        $this->nomSplit         = mb_strtolower($this->nomSplit);
        $this->nomSplit         = utf8_decode($this->nomSplit);
        $this->nomSplit         = str_split($this->nomSplit);
    
        $this->resultat_pierreDeBase            = 0;
        $this->resultat_pierreDeSommet          = 0;
        $this->resultat_pierreDeVie             = 0;
        $this->resultat_pierreDappel            = 0;
        $this->resultat_pierreDePersonnalite    = 0;
        $this->resultat_pierreDexpression       = 0;
        $this->resultat_pierreDeTouche          = 0;
        $this->resultat_pierreDeVoeux           = 0;

        
    }

    // 
    // PIERRE D'APPEL // Somme des voyelles des noms et prÃ©noms.
    // 
    public function pierreDappel()
    {
        foreach($this->nomSplit as $nom){
            foreach(BaseDeCalcul::$voyelles as $voyelle){
                if ($nom == utf8_decode($voyelle[0])){
                    $this->resultat_pierreDappel += $voyelle[1];
                    echo '</br>valeur pierre appel'.$this->resultat_PierreDappel;
                }
            }
        }
        $this->valeur_pierreDappel = $this->resultat_pierreDappel;
        siResultatSuperieur33($this->resultat_pierreDappel);
    }       



    // 
    // PIERRE DE PERSONNALITE
    // Somme des consonnes des noms et prénoms.
    // 
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
        siResultatSuperieur33($this->resultat_pierreDePersonnalite);
    }



    // 
    // PIERRE D EXPRESSION
    // Somme de la pierre d'Appel et Personnalité (non réduite).
    // 
    public function pierreDexpression()
    {
        $this->valeur_pierreDexpression       = $this->resultat_pierreDexpression;
        $this->resultat_pierreDexpression     = $this->valeur_pierreDappel + $this->pierreDePersonnalite;
        siResultatSuperieur33($this->resultat_pierreDexpression);
    }



    // 
    // PIERRE DE TOUCHE
    // Somme de toutes les pierres sauf chemin de vie et voeux (non réduite).
    // 
    public function pierreDeTouche(){
        $this->resultat_pierreDeTouche  = $this->valeur_pierreDeBase
                                        + $this->valeur_pierreDeSommet
                                        + $this->valeur_pierreDappel
                                        + $this->valeur_pierreDePersonnalite
                                        + $this->valeur_pierreDexpression;
                            
        if ($this->resultat_pierreDeTouche>33){
            $newResult = str_split($this->resultat_pierreDeTouche);
            $this->resultat_pierreDeTouche = 0;
            foreach($newResult as $newR){
                $this->resultat_pierreDeTouche += $newR;
            }    
        }
    }
}
