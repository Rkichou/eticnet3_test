<?php 
		session_start();
		require_once("../config.inc.php");
		require_once("../languages.inc.php");
		// Controle si une session est active
		// Si non active on stop le script
		require_once("./is_session_active.php");
		// Récupèration de l'image
		list($width, $height) = getimagesize($_GET['fileName']);
		// echo $width . "<br/>" . $height ;
		$width=$width/12;
		$height=$height/12;
		// echo $width . "<br/>" . $height ;	
		
		// die();
		// Nom du fichier PDF
		$tbl_fileName=explode("/",$_GET['fileName']);
		$dateFile=date('YmdHis');
		$filename="/home/eticnet/www/documents/"  . $_SESSION['prefix_contractor'] . "/pdfs/" . $tbl_fileName[count($tbl_fileName)-1] . "_" . $dateFile . ".pdf";
		$filename2="/documents/"  . $_SESSION['prefix_contractor'] . "/pdfs/" . $tbl_fileName[count($tbl_fileName)-1] . "_" . $dateFile . ".pdf";
		
		//
		// echo  $filename;
		$chaine="<page backtop=0mm>";
		$chaine.="<img src='" . $_GET['fileName'] ."' style='height:100%'>";
		$chaine.= "</page>"; 
		// echo $chaine;
		 
	// require_once('../html2pdf/html2pdf.class.php');
	require_once dirname(__FILE__).'/../vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Exception\Html2PdfException;
	use Spipu\Html2Pdf\Exception\ExceptionFormatter;

    $html2pdf = new HTML2PDF('P',array($width,$height),'fr'); // Image en 300 DPI
	$html2pdf->pdf->SetDisplayMode('real');
	$html2pdf->pdf->SetCompression(false);

    $html2pdf->WriteHTML($chaine);
    $html2pdf->Output($filename,"F");
	echo "Clic <a href=\"" . $filename2 . "\" download>Here</a> to download PDF File";
	
		