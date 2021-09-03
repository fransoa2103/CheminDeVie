<?php
require_once 'BaseDeCalcul.php';

class Bracelet extends BaseDeCalcul {
    
    
    public function __construct($data_formulaire){

        // ATTRIBUTS
        $this->tab_nomsPrenoms  = $data_formulaire;
        $this->prenoms          = htmlspecialchars($data_formulaire['prenoms']);
        $this->nomPere          = htmlspecialchars($data_formulaire['nomPere']);
        $this->nomMere          = htmlspecialchars($data_formulaire['nomMere']);
        $this->dateNaissance    = htmlspecialchars($data_formulaire['dateNaissance']);
        $this->dateNaissance    = explode("-",$this->dateNaissance);
        
        $this->nombreChampsFormulaire = count($data_formulaire)+1; // si un jour le nombre de champs de saisie évolue
        
        $this->pierreDeBase         = 0;
        $this->pierreDeSommet       = 1;
        $this->pierreDeVie          = 2;
        $this->pierreDappel         = 3;
        $this->pierreDePersonnalite = 4;
        $this->pierreDexpression    = 5;
        $this->pierreDeTouche       = 6;
        $this->pierreDeVoeux        = 7;
        
        // METHODES
        $this->fusionDesNomsPrenoms();
        $this->controleDuFormulaire();
        $this->pierreDappelVoeuxBasePersonnaliteSommet();
        $this->pierreDexpression();
        $this->pierreDeTouche();
        $this->pierreDeVie();
        $this->siResultatSuperieur33();
        
    }

    // FUNCTION controleDuFormulaire
    // ici la fonction controle la validité des 3 champs du formulaire
    // si un caractère non alphabétique est trouvé, une erreur = 1 est retournée
    // this function control validity for the 3 values of the form
    // if one no-alphabetic character is find, then error return = 1
    private function controleDuFormulaire(){ 
        
        foreach($this->tab_nomsPrenoms as $nomPrenom){
            $nomPrenom = utf8_decode($nomPrenom);
            if ((preg_match_all('/[\/\\\&~"#{([`_^@)°%=}+$£¤¨%µ*§!:;.,?0-9\'\]]/',$nomPrenom))){ 
                header('location:http://localhost/CheminDeVie/index.php?error=1&message=Attention, Vous ne devez saisir que des caractères de l\'alphabet');
                exit();
            }
        }
    }

    // FUNCTION fusionDesNomsPrenoms
    // En fusionnant les champs noms et prenoms, cela permet de faire 5 calculs de pierres en 1 seule boucle
    // Mais le champs [prenoms] doit vérifier s'il existe plusieurs prénoms car pour lle 
    // 1> je scinde les prénoms $tab_nomsPrenoms['prenoms']
    // 2> puis ils sont fusionnés avec le nom du pere et le nom de la mere en un seul tableau
    // 1> split $tab_nomsPrenoms['prenoms']
    // 2> firstnames are merge with dad & mother name, result all in one 
     

    private function fusionDesNomsPrenoms(){
        array_pop($this->tab_nomsPrenoms);  // efface le champs date de naissance // delete birthday
        $prenoms = str_split($this->tab_nomsPrenoms['prenoms']); // $prenoms contiendra tous le champs des prénoms saisis sous forme d'une longue chaine pour pouvoir naviguer lettre par lettre
        $prenoms_tampon = ""; // crée variable tampon pour fabriquer le nouveau tableau // create new val buffer to build new tab
        foreach($prenoms as $lettre_prenom){ 
            if ($lettre_prenom != " "){
                $prenoms_tampon = $prenoms_tampon.$lettre_prenom;
            }
            else
            {
                array_push($this->tab_nomsPrenoms,$prenoms_tampon);
                $prenoms_tampon ="";
            }
        }
        array_push($this->tab_nomsPrenoms, $prenoms_tampon); // ajoute le dernier champs trouvé à la fin de la boucle
        array_shift($this->tab_nomsPrenoms); // efface le champs des prenoms pour éviter un doublon et une erreur
    }



    private function pierreDappelVoeuxBasePersonnaliteSommet() {
        
        foreach ($this->tab_nomsPrenoms as $nomPrenom){ // $nomPrenom = nom ou prenom du formulaire
            $nomPrenom = mb_strtolower($nomPrenom); 
            $nomPrenom = utf8_decode($nomPrenom);
            $pierreDeVoeux_premiereVoyelle = true; // pierre de voeux ne compte que la 1ère voyelle trouvée
            for ($i = 0; $i<strlen($nomPrenom) ; $i++){ // boucle sur toutes les lettres des noms et prenoms
                foreach(BaseDeCalcul::$voyelles as $voyelle){ // boucle sur toutes les VOYELLES des lettres des noms et prenoms
                    if ($nomPrenom[$i] == utf8_decode($voyelle[0])){
                        // PIERRE d APPEL
                        BaseDecalcul::$formules[$this->pierreDappel][1] += $voyelle[1];
                        // PIERRE de VOEUX
                        if($pierreDeVoeux_premiereVoyelle){
                            BaseDecalcul::$formules[$this->pierreDeVoeux][1] += $voyelle[1];
                            $pierreDeVoeux_premiereVoyelle = false;
                        }
                        // PIERRE de BASE
                        if($i == 0){
                            BaseDecalcul::$formules[$this->pierreDeBase][1] += $voyelle[1];
                        }
                        // PIERRE de SOMMET
                        if($i == (strlen($nomPrenom)-1)){
                            BaseDecalcul::$formules[$this->pierreDeSommet][1] += $voyelle[1];
                        }
                    }
                }
                
                // boucle sur toutes les CONSONNES des lettres des noms et prenoms
                foreach(BaseDeCalcul::$consonnes as $consonne){
                    if ($nomPrenom[$i] == utf8_decode($consonne[0])){
                        // PIERRE de PERSONNALITE
                        BaseDecalcul::$formules[$this->pierreDePersonnalite][1] += $consonne[1];
                        // PIERRE de BASE
                        if($i == 0){
                            BaseDecalcul::$formules[$this->pierreDeBase][1] += $consonne[1];
                        }
                        // PIERRE de SOMMET
                        if($i == (strlen($nomPrenom)-1)){
                            BaseDecalcul::$formules[$this->pierreDeSommet][1] += $consonne[1];
                        }
                    }
                }
            }
        }
    }
  
    // PIERRE D EXPRESSION
    // Somme de la pierre d'Appel et Personnalité (non réduite).
    private function pierreDexpression()
    {
        BaseDecalcul::$formules[$this->pierreDexpression][1] =
                    + BaseDecalcul::$formules[$this->pierreDappel][1]
                    + BaseDecalcul::$formules[$this->pierreDePersonnalite][1];
    }

    // PIERRE DE TOUCHE
    // Somme de toutes les pierres (résultat non réduits) sauf chemin de vie et voeux.
    private function pierreDeTouche(){
        BaseDecalcul::$formules[$this->pierreDeTouche][1]  =
                    + BaseDecalcul::$formules[$this->pierreDeBase][1]
                    + BaseDecalcul::$formules[$this->pierreDeSommet][1]
                    + BaseDecalcul::$formules[$this->pierreDappel][1]
                    + BaseDecalcul::$formules[$this->pierreDePersonnalite][1]
                    + BaseDecalcul::$formules[$this->pierreDexpression][1]; 
                }

    // PIERRE DE CHEMIN DE VIE
    // la somme de la date de naissance
    private function pierreDeVie(){
        foreach($this->dateNaissance as $date){
            // floatval retourne la valeur decimale ex: 1969+03+21 
            BaseDecalcul::$formules[$this->pierreDeVie][1] += floatval($date);
        }
    }

    // FUNCTION RETURN RESULTAT
    // si les sommes trouvées sont supérieures à 33 = nombre de pierre max
    private function siResultatSuperieur33(){
        
        for ($i = 0; $i<count(BaseDeCalcul::$formules); $i++){
            // l'index [$i][1] garde sa valeur de base et l'index [$i][2] recoit la même valeur ou sa valeur recalculée si > 33
            // BaseDeCalcul::$formules[$i][2] = BaseDeCalcul::$formules[$i][1];

            if (BaseDeCalcul::$formules[$i][1]>33){
                $resultat = str_split(BaseDeCalcul::$formules[$i][1]);
                BaseDeCalcul::$formules[$i][1] = 0;
                foreach($resultat as $index){
                    BaseDeCalcul::$formules[$i][1] += $index;
                } 
            }
        }
    }
}
