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
        
        // pour une meilleure lecture du code j'attribue un nom de constante pour chacune des 8 formules 
        // cela revient à écrire BaseDecalcul::$formules[$this->pierreDeVoeux] plutot que BaseDecalcul::$formules[7]
        // ce n'est peut-être une bonne pratique mais pour moi (dans un an ou plus) ou pour une tierce personne cela sera plus facile à lire.
        $this->pierreDeBase         = 0;
        $this->pierreDeSommet       = 1;
        $this->pierreDeVie          = 2;
        $this->pierreDappel         = 3;
        $this->pierreDePersonnalite = 4;
        $this->pierreDexpression    = 5;
        $this->pierreDeTouche       = 6;
        $this->pierreDeVoeux        = 7;
        
        // METHODES à exécuter impérativemet dans cet ordre sous peine d'erreur
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
    // comme toutes les formules se calculent avec l'ensemble des noms et prénoms
    // je fusionne les champs noms et prenoms, cela permet de faire 5 calculs de pierres en 1 seule boucle
    // je scinde les prénoms str_split($this->tab_nomsPrenoms['prenoms'])
    // puis ils sont fusionnés avec le nom du pere et le nom de la mere en un seul tableau
    // j'efface le champs date de naissance // delete birthday
    // $prenoms contiendra tous le champs des prénoms saisis sous forme d'une longue chaine pour pouvoir naviguer lettre par lettre
    // je crée une variable tampon pour fabriquer le nouveau tableau
    // j'ajoute le dernier champs trouvé à la fin de la boucle
    // j'efface le champs des prenoms pour éviter un doublon et donc une erreur de calcul

    private function fusionDesNomsPrenoms(){
        array_pop($this->tab_nomsPrenoms);  
        $prenoms = str_split($this->tab_nomsPrenoms['prenoms']); 
        $prenoms_tampon = ""; 
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
        array_push($this->tab_nomsPrenoms, $prenoms_tampon);
        array_shift($this->tab_nomsPrenoms);
    }

    // FONCTION des 5 calculs des formules des pierres de
        // - APPEL
        // - VOEUX
        // - BASE
        // - PERSONNALITE
        // - SOMMET
        // La fonction effectue une boucle générale dans le tableau contenant les prénoms et les noms
        // A l'inntérieur 2 boucles: une cherche les voyelles et la seconde cherche les consonnes
        // elle compare chaque caractère trouvé avec les tableaux voyelles[0] et consonnes[0]
        // et pour chaque formule on attribue la valeur correspondante voyelles[1] et/ou consonnes[1]

    private function pierreDappelVoeuxBasePersonnaliteSommet() {
        
        foreach ($this->tab_nomsPrenoms as $nomPrenom){ 
            $nomPrenom = mb_strtolower($nomPrenom); 
            $nomPrenom = utf8_decode($nomPrenom);
            $pierreDeVoeux_premiereVoyelle = true; 

            // boucle sur toutes les lettres des noms et prenoms
            for ($i = 0; $i<strlen($nomPrenom) ; $i++){ 

                // I.
                // recherche les VOYELLES des lettres des noms et prenoms
                // voyelle[1] contient la valeur décimale
                foreach(BaseDeCalcul::$voyelles as $voyelle){ 

                    if ($nomPrenom[$i] == utf8_decode($voyelle[0])){

                        // Ia.
                            // PIERRE D' APPEL
                            // Somme des voyelles des noms et prénoms.
                            BaseDecalcul::$formules[$this->pierreDappel][1] += $voyelle[1];
                        
                        // Ib.
                            // PIERRE DE VOEUX
                            // Somme de la première voyelle des prénoms et noms.
                        if($pierreDeVoeux_premiereVoyelle){
                            BaseDecalcul::$formules[$this->pierreDeVoeux][1] += $voyelle[1];
                            $pierreDeVoeux_premiereVoyelle = false;
                        }
                        
                        // Ic.
                            // PIERRE DE BASE
                            // Somme des Premières lettre des prénoms et des noms.
                        if($i == 0){
                            BaseDecalcul::$formules[$this->pierreDeBase][1] += $voyelle[1];
                        }
                        
                        // Id.
                            // PIERRE DE SOMMET
                            // Somme de la dernière lettres des prénoms et des noms.
                        if($i == (strlen($nomPrenom)-1)){
                            BaseDecalcul::$formules[$this->pierreDeSommet][1] += $voyelle[1];
                        }
                    }
                }
                
                // II.
                // recherche les CONSONNES des lettres des noms et prenoms
                // consonne[1] contient la valeur décimale
                foreach(BaseDeCalcul::$consonnes as $consonne){

                    if ($nomPrenom[$i] == utf8_decode($consonne[0])){

                        // IIa.                            
                            // PIERRE DE PERSONNALITE
                            // Somme des consonnes des noms et prénoms
                            BaseDecalcul::$formules[$this->pierreDePersonnalite][1] += $consonne[1];
                        
                        // IIb.                            
                            // PIERRE DE BASE
                            // Somme des Premières lettre des prénoms et des noms.
                        if($i == 0){
                            BaseDecalcul::$formules[$this->pierreDeBase][1] += $consonne[1];
                        }

                        // IIc.                            
                            // PIERRE DE SOMMET
                            // Somme de la dernière lettres des prénoms et des noms.
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
    // Somme de toutes les pierres sauf chemin de vie et voeux.
    // Somme des résultat non réduits
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
    // si la somme trouvée est supérieure à 33 = nombre de pierre max
    // alors la valeur est convertit en une chaine
    // puis on additionne les valeur comme suit
    // ex BaseDeCalcul::$formules[$i][1] = 117
    // alors 117 => '1'+'1'+'7' = 9
    private function siResultatSuperieur33(){
        for ($i = 0; $i<count(BaseDeCalcul::$formules); $i++){
            if (BaseDeCalcul::$formules[$i][1]>33){
                $resultat = str_split(BaseDeCalcul::$formules[$i][1]);
                BaseDeCalcul::$formules[$i][1] = 0;
                foreach($resultat as $index){
                    BaseDeCalcul::$formules[$i][1] += $index;
                } 
            }
            BaseDeCalcul::$formules[$i][1]= BaseDeCalcul::$formules[$i][1]-1;
        }
    }
}
