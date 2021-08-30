<?php
    function siResultatSuperieur33($resultat){
        if ($resultat>33){
            $newResult = str_split($resultat);
            $resultat = 0;
            foreach($newResult as $newR){
                $resultat = $resultat + $newR;
            }    
        }
    }