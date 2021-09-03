<?php session_start(); ?>

<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require_once '../Class/Bracelet.php';

require_once '../dompdf/autoload.inc.php';

$dompdf = new Dompdf(); // appel la Class création nouveau fichier.pdf

$options = new Options(); // apple la Class des options
$options->set('defaultFont', 'courier');
$dompdf = new Dompdf($options);


ob_start();
require_once 'test2.php';
$html = ob_get_contents();
ob_end_clean();


$dompdf->loadHtml($html); // charge du code html
$dompdf->setPaper('A4', 'portrait'); // définit le format de page
$dompdf->render(); // génère le fichier en mémoire

$fichier = 'fichier Chemin de Vie.pdf';
$dompdf->stream($fichier); // créee le fichier en ligne