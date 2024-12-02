<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
    ob_start();
    include("" . $_GET['fileToExport']);
    $content = ob_get_clean();

    // convert to PDF
    require_once(dirname(__FILE__).'/html2pdf.class.php');
    try
    {
		$format=array("80","110");
        $html2pdf = new HTML2PDF('P', $format, 'fr', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$d=date("Ymdhis");
		$nomPdf="/home/www/pdfs/devis_en_attente_pdfs/out_" .$d . "_" . ".pdf";
		$nomPdfLink="/pdfs/devis_en_attente_pdfs/out_" . $d . "_" . ".pdf";
        $html2pdf->Output($nomPdf,"F");
		echo "<a href='" . $nomPdfLink . "'/>lire </a>";
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
