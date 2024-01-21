<?php
require_once('tcpdf/tcpdf.php');



$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
$pdf->SetCreator('PDF_CREATOR');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('My Home Page PDF');
$pdf->SetHeaderData('', 0, '', '');
$pdf->SetFooterData('', 0, '', '');

ob_start();
include('../FutureTech/invoice.php'); // Include the content of your home.php file
$content = ob_get_clean();
$pdf->AddPage();
$pdf->writeHTML($content, true, false, true, false, '');

$pdf->Output('my_homepage.pdf', 'I'); // Output the PDF directly to the browser
