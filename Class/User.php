<?php
    require_once 'BaseDeCalcul.php';

    class User extends BaseDeCalcul {

        // ATTRIBUTS

        public $result_pierreDeBase;
        public $result_pierreDeSommet;
        public $result_pierreDappel;
        public $result_pierreDePersonnalite;
        public $result_pierreDeVoeux;
        public $result_pierreDeVie;
        public $result_pierreDexpression;
        public $result_pierreDeTouche;
        
        private $valeur_pierreDeBase;
        private $valeur_pierreDeSommet;
        private $valeur_pierreDappel;
        private $valeur_pierreDePersonnalite;
        private $valeur_pierreDexpression;

        //  CONSTRUCTOR

        public function __construct($data = null){

            $this->prenoms = htmlspecialchars($data['prenoms']);
            $this->nomPere = htmlspecialchars($data['nomPere']);
            $this->nomMere = htmlspecialchars($data['nomMere']);

            $this->prenoms = mb_strtolower($this->prenoms);
            $this->nomPere = mb_strtolower($this->nomPere);
            $this->nomMere = mb_strtolower($this->nomMere);
            
            $this->controleDuFormulaire($this->prenoms);
            $this->controleDuFormulaire($this->nomPere);
            $this->controleDuFormulaire($this->nomMere);

            $this->noms     = explode(" ",$this->prenoms);
            $this->nomPere  = explode(" ",$this->nomPere);
            $this->nomMere  = explode(" ",$this->nomMere);

            $this->noms     = array_merge($this->noms, $this->nomPere, $this->nomMere);

            $this->dateNaissance    = $data['dateNaissance'];

            $this->PierreDeBase();
            $this->PierreDeSommet();
            $this->PierreDeVie();
            $this->PierreDappel();
            $this->PierreDePersonnalite();
            $this->PierreDexpression();
            $this->PierreDeTouche();
            $this->PierreDeVoeux();
        }

        // FONCTIONS
    
        private function controleDuFormulaire($saisie){ 
            $saisie = utf8_decode($saisie);
            if (preg_match_all('/[\/\\\&~"#{([`_^@)°%=}+$£¤¨%µ*§!:;.,?0-9\'\]]/',$saisie)){ 
                header('location:http://localhost/CheminDeVie/index.php?error=1&message=saisie non valide !'.utf8_encode($saisie));
                exit();
            }
        }
        
        // 
        // LA PIERRE DE BASE est la somme des Premières lettres des prénoms et des noms.
        // 
        public function pierreDeBase(){
            $this->result_pierreDeBase = 0;
            foreach($this->noms as $nom){
                $nom = utf8_decode($nom);
                $nom = str_split($nom);
                // $lettre = str_split($nom);

                foreach(BaseDeCalcul::$consonnes as $consonne){
                    if ($nom[0] == utf8_decode($consonne[0])){
                        $this->result_pierreDeBase += $consonne[1];
                    }
                }
                foreach(BaseDeCalcul::$voyelles as $voyelle){
                    if ($nom[0] == utf8_decode($voyelle[0])){
                        $this->result_pierreDeBase += $voyelle[1];
                    }
                }
            }
            
            $this->valeur_pierreDeBase = $this->result_pierreDeBase;

            if ($this->result_pierreDeBase>33){
                $newResult = str_split($this->result_pierreDeBase);
                $this->result_pierreDeBase = 0;
                foreach($newResult as $newR){
                    $this->result_pierreDeBase += $newR;
                }    
            }
            $this->result_pierreDeBase = BaseDeCalcul::$pierres[$this->result_pierreDeBase-1];
        }
        
        // 
        // LA PIERRE DE SOMMET est la somme de la dernière lettres des prénoms et noms.
        // 
        public function pierreDeSommet(){
            
            $this->result_pierreDeSommet = 0;
            foreach($this->noms as $nom){
                $nom = utf8_decode($nom);
                $lettre = str_split($nom);
                foreach(BaseDeCalcul::$consonnes as $consonne){
                    if ($lettre[count($lettre)-1] == utf8_decode($consonne[0])){
                        $this->result_pierreDeSommet += $consonne[1];
                    }
                }
                foreach(BaseDeCalcul::$voyelles as $voyelle){
                    if ($lettre[count($lettre)-1] == utf8_decode($voyelle[0])){
                        $this->result_pierreDeSommet += $voyelle[1];
                    }
                }
            }

            $this->valeur_pierreDeSommet = $this->result_pierreDeSommet;

            if ($this->result_pierreDeSommet>33){
                $newResult = str_split($this->result_pierreDeSommet);
                $this->result_pierreDeSommet = 0;
                foreach($newResult as $newR){
                    $this->result_pierreDeSommet += $newR;
                }    
            }
            $this->result_pierreDeSommet = BaseDeCalcul::$pierres[$this->result_pierreDeSommet-1];

        }

        // 
        // LA PIERRE D'APPEL est la somme des voyelles des noms et prénoms.
        // 
        public function pierreDappel(){
            
            $this->result_pierreDappel = 0;
            foreach($this->noms as $nom){
                $nom = utf8_decode($nom);
                $splitPrenoms = str_split($nom);
                foreach($splitPrenoms as $lettre){
                    foreach(BaseDeCalcul::$voyelles as $voyelle){
                        if (utf8_encode($lettre) == $voyelle[0]){
                            $this->result_pierreDappel += $voyelle[1];
                        }
                    }
                }
            }   
            
            $this->valeur_pierreDappel = $this->result_pierreDappel;

            if ($this->result_pierreDappel>33){
                $newResult = str_split($this->result_pierreDappel);
                $this->result_pierreDappel = 0;
                foreach($newResult as $newR){
                    $this->result_pierreDappel += $newR;
                }    
            }
            $this->result_pierreDappel>0? $this->result_pierreDappel = BaseDeCalcul::$pierres[$this->result_pierreDappel-1]:'';

        }
        
        // 
        // LA PIERRE DE PERSONNALITE est la somme des consonnes des noms et prénoms.
        // 
        public function pierreDePersonnalite(){
            $this->result_pierreDePersonnalite = 0;
            foreach($this->noms as $nom){
                $splitPrenoms = utf8_decode($nom);
                $splitPrenoms = str_split($splitPrenoms);
                foreach($splitPrenoms as $lettre){
                    foreach(BaseDeCalcul::$consonnes as $bdc){
                        if ($lettre == utf8_decode($bdc[0])){
                            $this->result_pierreDePersonnalite = $this->result_pierreDePersonnalite + $bdc[1];
                        }
                    }
                }
            }   
            
            $this->valeur_pierreDePersonnalite = $this->result_pierreDePersonnalite;

            if ($this->result_pierreDePersonnalite>33){
                $newResult = str_split($this->result_pierreDePersonnalite);
                $this->result_pierreDePersonnalite = 0;
                foreach($newResult as $newR){
                    $this->result_pierreDePersonnalite = $this->result_pierreDePersonnalite + $newR;
                }    
            }
            $this->result_pierreDePersonnalite = BaseDeCalcul::$pierres[$this->result_pierreDePersonnalite-1];
        }
        
        public function pierreDeVoeux(){
            $this->result_pierreDeVoeux = 0;
            foreach($this->noms as $nom){
                $nom = utf8_decode($nom);
                $splitPrenoms = str_split($nom);
                $max = true;
                foreach($splitPrenoms as $sp){
                    $lettre = utf8_encode($sp);
                    foreach(BaseDeCalcul::$voyelles as $bdc){
                        if ($lettre == $bdc[0] && $max){
                            $this->result_pierreDeVoeux = $this->result_pierreDeVoeux + $bdc[1];
                            $max = false;
                        }
                    }
                }
            }   
            
            if ($this->result_pierreDeVoeux>33){
                $newResult = str_split($this->result_pierreDeVoeux);
                $this->result_pierreDeVoeux = 0;
                foreach($newResult as $newR){
                    $this->result_pierreDeVoeux = $this->result_pierreDeVoeux + $newR;
                }    
            }
            $this->result_pierreDeVoeux = BaseDeCalcul::$pierres[$this->result_pierreDeVoeux-1];
        }

        public function pierreDeVie(){
            $this->dateNaissance = explode("-",$this->dateNaissance);
            $this->result_pierreDeVie = 0;
            foreach($this->dateNaissance as $date){
                $this->result_pierreDeVie += floatval($date);
            }
            
            if ($this->result_pierreDeVie>33){
                $newResult = str_split($this->result_pierreDeVie);
                $this->result_pierreDeVie = 0;
                foreach($newResult as $newR){
                    $this->result_pierreDeVie = $this->result_pierreDeVie + $newR;
                }    
            }
            $this->result_pierreDeVie = BaseDeCalcul::$pierres[$this->result_pierreDeVie-1];
        }

        public function pierreDexpression(){
            $this->result_pierreDexpression = $this->valeur_pierreDappel + $this->valeur_pierreDePersonnalite;
            $this->valeur_pierreDexpression = $this->result_pierreDexpression;

            if ($this->result_pierreDexpression>33){
                $newResult = str_split($this->result_pierreDexpression);
                $this->result_pierreDexpression = 0;
                foreach($newResult as $newR){
                    $this->result_pierreDexpression = $this->result_pierreDexpression + $newR;
                }    
            }
            $this->result_pierreDexpression = BaseDeCalcul::$pierres[$this->result_pierreDexpression-1];
        }

        public function pierreDeTouche(){
            $this->result_pierreDeTouche =  $this->valeur_pierreDeBase
                                            + $this->valeur_pierreDeSommet
                                            + $this->valeur_pierreDappel
                                            + $this->valeur_pierreDePersonnalite
                                            + $this->valeur_pierreDexpression;

            if ($this->result_pierreDeTouche>33){
                $newResult = str_split($this->result_pierreDeTouche);
                $this->result_pierreDeTouche = 0;
                foreach($newResult as $newR){
                    $this->result_pierreDeTouche = $this->result_pierreDeTouche + $newR;
                }    
            }
            $this->result_pierreDeTouche = BaseDeCalcul::$pierres[$this->result_pierreDeTouche-1];
        }
    }
?>