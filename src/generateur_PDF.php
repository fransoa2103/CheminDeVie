<?php

session_start(); 

use Dompdf\Dompdf;
use Dompdf\Options;

require_once '../Class/Bracelet.php';
require_once '../dompdf/autoload.inc.php';

$dompdf = new Dompdf(); // appel la Class création nouveau fichier.pdf

$options = new Options(); // appel la Class des options
$options->set('defaultFont', 'courier');
// le s2 lignes de code suivantes trouvées sur stackoverflow ne fonctionnent pas. 
// $options->set('isRemoteEnabled',true);  
// $options->setIsRemoteEnabled(true);

// g donc trouvé et adopté une autre solution qui est de supprimer des lignes de codes
// dans le fichier /dompdf/src/img/cache.php
// les lignes 125 à 150 ont été mis en commentaire, et cela fonctionne pour afficher des ims à l'écran et en PDF
$dompdf = new Dompdf($options);

ob_start();
require_once 'page_PDF.php';
$html = ob_get_contents();
ob_end_clean();

$dompdf->loadHtml($html); // charge du code html
$dompdf->setPaper('A4', 'portrait'); // définit le format de page
$dompdf->render(); // génère le fichier en mémoire

$fichier = 'fichier Chemin de Vie.pdf';
$dompdf->stream($fichier); // créee le fichier en ligne