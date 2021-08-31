<?php
require_once 'BaseDeCalcul.php';
class Bracelet extends BaseDeCalcul {

    public function __construct($data){


        $this->dateNaissance    = htmlspecialchars($data['dateNaissance']);
        $this->dateNaissance    = explode("-",$this->dateNaissance);
    
        $this->resultat_pierreDeBase            = 0;
        $this->resultat_pierreDeSommet          = 0;
        $this->resultat_pierreDeVie             = 0;
        $this->resultat_pierreDappel            = 0;
        $this->resultat_pierreDePersonnalite    = 0;
        $this->resultat_pierreDexpression       = 0;
        $this->resultat_pierreDeTouche          = 0;
        $this->resultat_pierreDeVoeux           = 0;
        $this->resultat_nouveauCalcul           = 0;

        $this->pierreDappelVoeuxBasePersonnaliteSommet();
        $this->pierreDexpression();
        $this->pierreDeTouche();
        $this->pierreDeVie();
    }
    
    public function pierreDappelVoeuxBasePersonnaliteSommet() {
        
        $tab_nomPrenoms = [];
        $tab_nomPrenoms = $_POST['pre_noms'];
        $prenoms = str_split($tab_nomPrenoms[0]);
        $new = "";
        foreach($prenoms as $lettre_prenom){
            if ($lettre_prenom != " "){
                $new = $new.$lettre_prenom;
            }
            else
            {
                array_push($tab_nomPrenoms, $new);
                $new ="";
            }
        }
        array_push($tab_nomPrenoms, $new);
        array_shift($tab_nomPrenoms);

        foreach ($tab_nomPrenoms as $nom){
            $nom = htmlspecialchars($nom);
            $nom = mb_strtolower($nom); 
            $nom = utf8_decode($nom);

            $calcul_pierreDeVoeux = true;

            for ($i = 0; $i<strlen($nom) ; $i++){
                foreach(BaseDeCalcul::$voyelles as $voyelle){
                    if ($nom[$i] == utf8_decode($voyelle[0])){
                        $this->resultat_pierreDappel += $voyelle[1];
                        if($calcul_pierreDeVoeux){
                            $this->resultat_pierreDeVoeux += $voyelle[1];
                            $calcul_pierreDeVoeux = false;
                        }
                        if($i == 0){
                            $this->resultat_pierreDeBase += $voyelle[1];
                        }
                        if($i == (strlen($nom)-1)){
                            $this->resultat_pierreDeSommet += $voyelle[1];
                        }
                    }
                }
                
                foreach(BaseDeCalcul::$consonnes as $consonne){
                    if ($nom[$i] == utf8_decode($consonne[0])){
                        $this->resultat_pierreDePersonnalite += $consonne[1];
                        if($i == 0){
                            $this->resultat_pierreDeBase += $consonne[1];
                        }
                        if($i == (strlen($nom)-1)){
                            $this->resultat_pierreDeSommet += $consonne[1];
                        }
                    }
                }
            }
        }

        $this->valeur_pierreDappel = $this->resultat_pierreDappel;
        $this->siResultatSuperieur33($this->resultat_pierreDappel);
        $this->resultat_pierreDappel = $this->resultat_nouveauCalcul;

        $this->valeur_pierreDePersonnalite = $this->resultat_pierreDePersonnalite;
        $this->siResultatSuperieur33($this->resultat_pierreDePersonnalite);
        $this->resultat_pierreDePersonnalite = $this->resultat_nouveauCalcul;
        
        $this->valeur_pierreDeVoeux = $this->resultat_pierreDeVoeux;
        $this->siResultatSuperieur33($this->resultat_pierreDeVoeux);
        $this->resultat_pierreDeVoeux = $this->resultat_nouveauCalcul;
        
        $this->valeur_pierreDeBase = $this->resultat_pierreDeBase;
        $this->siResultatSuperieur33($this->resultat_pierreDeBase);
        $this->resultat_pierreDeBase = $this->resultat_nouveauCalcul;
        
        $this->valeur_pierreDeSommet = $this->resultat_pierreDeSommet;
        $this->siResultatSuperieur33($this->resultat_pierreDeSommet);
        $this->resultat_pierreDeSommet = $this->resultat_nouveauCalcul;
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
