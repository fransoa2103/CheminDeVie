<?php 
    class BaseDeCalcul {
        public static $consonnes = [
            ['b',2],['c',3],['ç',1],['d',4],['f',6],['g',7],['h',8],
            ['j',1],['k',2],['l',3],['m',4],['n',5],['p',7],['q',8],
            ['r',9],['s',1],['t',2],['v',4],['w',5],['x',6],['z',8]
        ];
        public static $voyelles = [
            ['a',1],['à',9],['ä',6],['â',9],
            ['e',5],['é',1],['è',1],['ê',1],['ë',5],
            ['i',9],['ï',9],['î',5],
            ['o',6],['ö',2],['ô',6],
            ['u',3],['ù',3],['û',3],['ü',8],
            ['y',7]
        ];
        public static $pierres = [
            'quartz-rose','jasper-rouge','calcedoine','jade','emeraude','grenat', 'citrine',
            'obsidienne','aigue-marine','rhodochrosite','cornaline','ambre', 'hematite',
            'amethyste', 'malachite', 'opale', 'turquoise', 'pierre-de-lune','topaze', 'lapis-lazuli',
            'tourmaline', 'cristal-de-roche', 'azurite', 'amazonite','oeil-de-tigre', 'pyrite',
            'fluorite', 'perle', 'sodalite', 'quartz-fume','souffre', 'mercure', 'sel'
        ];
        public static $formules = [
            ['pierreDeBase', 0],
            ['pierreDeSommet', 0],
            ['pierreDeVie', 0],
            ['pierreDappel', 0],
            ['pierreDePersonnalite', 0],
            ['pierreDexpression', 0],
            ['pierreDeTouche', 0],
            ['pierreDeVoeux', 0]
        ];
        
    }
?>