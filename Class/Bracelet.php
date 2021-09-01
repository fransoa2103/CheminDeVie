<?php
require_once 'BaseDeCalcul.php';
class Bracelet extends BaseDeCalcul {

    public function __construct($data){

        $this->nombreChampsFormulaire = count($data)+1; // si un jour le nombre de champs de saisie évolue
        $this->controleDuFormulaire($data);
        
        $this->tab_nomsPrenoms  = $data['pre_noms'];
        $this->fusionDesNomsPrenoms();

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

    
    // ici la fonction controle la validité des 3 champs du formulaire
    // si un caractère non alphabétique est trouvé, une erreur = 1 est retournée
    // this function control validity for the 3 values of the form
    // if one no-alphabetic character is find, then error return = 1
    private function controleDuFormulaire($data_form){ 

        for ($i = 0; $i<$this->nombreChampsFormulaire; $i++){
            $data_form['pre_noms'][$i] = utf8_decode($data_form['pre_noms'][$i]);
            if (preg_match_all('/[\/\\\&~"#{([`_^@)°%=}+$£¤¨%µ*§!:;.,?0-9\'\]]/',$data_form['pre_noms'][$i])){ 
                header('location:http://localhost/CheminDeVie/index.php?error=1&message=Attention, Vous ne devez saisir que des caractères de l\'alphabet');
                exit();
            }
        }

    }

    // fonction fusion des champs noms et prenoms, ainsi 5 calculs de pierres se font en 1 seule boucle
    // merge function fields name + firstname then 5 stone calcul are done in one single loop

    private function fusionDesNomsPrenoms(){
        $prenoms = str_split($this->tab_nomsPrenoms[0]);
        $new = ""; // temp var
        
        // 1> je scinde les prénoms $tab_nomsPrenoms[0]
        // 2> puis ils sont fusionnés avec le nom du pere et le nom de la mere
        // 1> split $tab_nomsPrenoms[0]
        // 2> firstnames are merge with dad & mother name  
        // 3> result only tab_nomsPrenoms 

        foreach($prenoms as $lettre_prenom){ 
            if ($lettre_prenom != " "){
                $new = $new.$lettre_prenom;
            }
            else
            {
                array_push($this->tab_nomsPrenoms, $new);
                $new ="";
            }
        }
        array_push($this->tab_nomsPrenoms, $new); // ajoute le dernier champs trouvé à la fin de la boucle
        array_shift($this->tab_nomsPrenoms); // efface le champs des prenoms pour éviter un doublon et une erreur
    }



    public function pierreDappelVoeuxBasePersonnaliteSommet() {
        
        foreach ($this->tab_nomsPrenoms as $nom){
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
