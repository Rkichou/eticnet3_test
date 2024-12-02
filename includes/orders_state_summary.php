<?php	
	require_once("../config.inc.php");
	require_once("./is_session_active.php");
	$statut[0]='Canceled';
	$statut[1]='Not confirmed';
	$statut[2]='Pending';
	$statut[3]='Pending';
	$statut[4]='Pending';
	$statut[5]='In production';
	$statut[6]='In Quality'; 
	$statut[7]='Delivered';
	$statut[8]='Product By Supplier';
	$statut[9]='In delivery';
		
		$prefix_contractor=$_GET['prefix'];
		//Rècupère l'id contractor pour la selection des adresses façonniers
		$sql2="select * from `contractors` where `prefix`='" . $_SESSION['prefix_contractor']. "' limit 1";
		$retour2=mysqli_query($con,$sql2); 
		$row2=mysqli_fetch_object($retour2);
		$idConctractor=$row2->id;
		$conctractor=$row2->name;
		
		// Rècupère les printshops
		$sql2="select * from printshop order by name";
		$retour2=mysqli_query($con,$sql2); 
		while($row2=mysqli_fetch_array($retour2))
		{
			$tbl_printshop[$row2['id']] = $row2['name'];
			
		}
		////////////////////////////////////////////////////////////////////			
		$filename = dirname(__DIR__) . "../documents/"  . $prefix_contractor . "/pdfs/orders_summary_".  $prefix_contractor .  "_" . date('Y-m-d') . ".pdf";
		
		// 		
		$marge = "5mm";				
		$chaine="<page backtop=30mm backbottom=15mm backleft=5mm backright=5mm>";
		$chaineLogo=$chaineDate="";$chaine2="";$chaineFooter="";
		$bottom=0;
		$chaineFooter.="<page_footer> ";
          //FOOTER	
			$chaineFooter.="<table style='width:100%;'>";
			$chaineFooter.="<tr><td style='text-align:left;width:50%;'><img src='../images/myeticnet.png' style='height:18px'></td>";

			$chaineFooter.="<td style='text-align:right;width:50%;'><span style='Font-weight:400'>[[page_cu]]/[[page_nb]]</span></td>";

			$chaineFooter.="</tr></table>";
			$chaineFooter.="</page_footer>";
			$chaine.=$chaineFooter;
		
			//LOGOS
			$chaine.="<page_header> ";
			$chaineLogo.="<table style='position: relative;width:95%;left:5mm;height:15mm;'>";
			$chaineLogo.="<tr><td style='width:62mm;height:15mm;text-align:left'><img src='../images/etic_europe.png' style='height:30px'></td>";
		
			$chaineLogo.="<td style='width:62mm;height:15mm;text-align:center'><h2 style='Font-weight:400'>Orders state summary</h2></td>";
			$chaineLogo.="<td style='width:62mm;height:15mm;text-align:right'><img src='../images/logos_clients/" . $prefix_contractor . ".png' style='height:30px'></td>";
		$chaineLogo.="</tr></table>";
		$bottom+=10;
		$chaine.=$chaineLogo;	
			//DATE + OF
		$chaineDate.="<table style='position: relative;width:95%;left:5mm;height:10mm;'>";
			$chaineDate.="<tr><td style='width:50%;height:10mm;'>";
				$chaineDate.="<span style='font-size:20px;'>Date : " . date('d/m/Y')  ."</span >"; 
			$chaineDate.="</td>";
			$chaineDate.="</tr>";
		$chaineDate.="</table>";
		$chaine.=$chaineDate;
		//$chaine.="<br/><br/>";
		$chaine.="</page_header>";
		$bottom+=15;
		// Fetch printshops
		$sqlPrintshop = "SELECT DISTINCT(id_printshop) FROM `" . $prefix_contractor . "_orders`"; 
		$retourPrintshop = mysqli_query($con, $sqlPrintshop);

		while ($rowPrintshop = mysqli_fetch_array($retourPrintshop)) 
		{
			//$chaine.="<br/> Printshop ". $rowPrintshop['id_printshop'] ;
			$bottom += 10;				
			$tot = 0;

			// Initialize arrays to store data with zero-filled default values
			$data = [];
			$statuses = range(0, 9); // Array with all statuses from 0 to 9
			$typeLabels = [];

			// Pre-populate data array with all statuses and type labels with quantity 0
			foreach ($statuses as $status) {
				foreach ($typeLabels as $typeLabel) {
					$data[$typeLabel][$status] = 0;
				}
			}
			// Query to get actual quantities for this printshop and grouped statuses
			$sql = " SELECT 
        	CASE 
				WHEN status = 0 THEN '0'
				WHEN status = 1 THEN '1'
            	WHEN status IN (2, 3, 4) THEN '4'
				WHEN status = 5 THEN '5'
				WHEN status IN (6, 9) THEN '6'
				WHEN status IN (8, 7) THEN '7'
			END AS status_group, type_label, SUM(qty_to_produce) AS total_qty
			FROM  " . $prefix_contractor . "_orders
			WHERE id_printshop = " . $rowPrintshop['id_printshop'] . "
			GROUP BY 
				status_group, 
				type_label
			ORDER BY 
				status_group, 
				type_label;"; 

			$retour = mysqli_query($con, $sql);
			// Initialize arrays to store data
			$data = [];
			$statuses = [];
			$typeLabels = [];
			$statusTotals = [];  // Store totals for each status (vertical)
			$typeLabelTotals = [];  // Store totals for each type_label (horizontal)
			$j=0;
			// Process actual quantities from the query result
			while ($row = mysqli_fetch_assoc($retour)) {
				$status = $row['status_group'];
				$typeLabel = $row['type_label'];
				$totalQty = $row['total_qty'];

				// Populate data arrays
				$data[$typeLabel][$status] = $totalQty;
				$statuses[$status] = true;
				$typeLabels[$typeLabel] = true;

				// Calculate horizontal totals for each type_label
				if (!isset($typeLabelTotals[$typeLabel])) {
					$typeLabelTotals[$typeLabel] = 0;
				}
				$typeLabelTotals[$typeLabel] += $totalQty;

				// Calculate vertical totals for each status
				if (!isset($statusTotals[$status])) {
					$statusTotals[$status] = 0;
				}
				$statusTotals[$status] += $totalQty;
			}
			// Calculate grand total
			$grandTotal = array_sum($statusTotals);
			// Initialize totals for each status and type_label
			
			// Ensure $statusTotals is initialized with all possible statuses
			foreach ($statuses as $status => $_) {
				$possibleStatuses[]=$status;
			}
			$possibleStatuses = ['0', '1', '4', '5', '6', '7']; // Replace with actual statuses
			$statusTotals = array_fill_keys($possibleStatuses, 0);
			$typeLabelTotals = array_fill_keys(array_keys($typeLabels), 0);  // Store totals for each type_label (horizontal)
			$grandTotal = 0;

			// Calculate horizontal and vertical totals
			foreach ($data as $typeLabel => $statusData) {
				foreach ($statusData as $status => $qty) {
					$typeLabelTotals[$typeLabel] += $qty;
					// Safely update the count
					if (isset($statusTotals[$status])) {
						$statusTotals[$status] += $qty;
					} else {
						// Optional: Handle unexpected status keys if necessary
						$statusTotals[$status] = $qty; // Initialize with current qty
					}
					$grandTotal += $qty;
				}
			}
			// Generate the HTML table
			$chaine.= "<table style='position: relative;width:100%;border: solid 1px #000; border-radius: 5px; top:7mm;text-align:center;'>";
			$chaine.= "<thead>";
			$chaine.="<tr style='font-size:11px;text-align:center;background-color:#555;color:#fff'>";
				$chaine.="<td colspan='8' style='height:8mm;border-bottom:1px solid #000;border-right:1px solid #000;font-size:14px; font-weight:700'>".$tbl_printshop[$rowPrintshop['id_printshop']]." </td>";
					
			$chaine.="</tr>";
			$chaine.= "<tr style='font-size:11px;text-align:center;'>";
			$chaine.= "<th style='height:8mm;width:60mm;border-bottom:1px solid #000;border-right:1px solid #000;'>State</th>";

			// Header row with statuses
				foreach ($possibleStatuses as $status) {
					$chaine .= "<th style='height:8mm;width:15mm;border-bottom:1px solid #000;border-right:1px solid #000;'>" . $statut[$status] . "</th>";
				}
				$chaine.= "<th style='height:8mm;width:15mm;border-bottom:1px solid #000;'>Total</th>"; // Horizontal total column
			$chaine.= "</tr>";
			$chaine.= "</thead>";
			$chaine.= "<tbody>";
				// Rows with type labels and quantities, including zeros
				foreach ($typeLabels as $typeLabel => $_) {
					$chaine .= "<tr style='background-color:#FFFFFF;color:#000;font-size:11px;text-align:center;'>";
					$chaine .= "<td style='height:8mm;width:65mm;border-bottom:1px solid #000;border-right:1px solid #000;'>$typeLabel</td>";

					$rowTotal = 0;

					foreach ($possibleStatuses as $status) {
						// Afficher 0 si la combinaison type_label et statut n'existe pas
						$qty = isset($data[$typeLabel][$status]) ? $data[$typeLabel][$status] : 0;
						$chaine .= "<td style='height:8mm;width:15mm;border-bottom:1px solid #000;border-right:1px solid #000;'>$qty</td>";
						$rowTotal += $qty;
					}

					$chaine .= "<td style='height:8mm;width:15mm;border-bottom:1px solid #000;'>$rowTotal</td>";
					$chaine .= "</tr>";
				}
				// Display vertical totals for each status
				$chaine.= "<tr ><td style='height:8mm;width:15mm;border-right:1px solid #000;'>Total</td>";
				
				foreach ($possibleStatuses as $status) {
					$totalForStatus = isset($statusTotals[$status]) ? $statusTotals[$status] : 0;
					$chaine .= "<td style='height:8mm;width:15mm;border-right:1px solid #000;'>$totalForStatus</td>";
				}
				$chaine.= "<td style='height:8mm;width:15mm;'>".array_sum($statusTotals)."</td>"; // Display grand total
				$chaine.= "</tr>";
			$chaine.= "</tbody>";
			$chaine.= "</table>";
		
		}			
	$chaine.= "</page>";

	require_once dirname(__FILE__).'/../vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;
	use Spipu\Html2Pdf\Exception\Html2PdfException;
	use Spipu\Html2Pdf\Exception\ExceptionFormatter;
//echo $chaine;
    // Create the PDF
    try {
        $html2pdf = new Html2Pdf('P', 'A4', 'fr', false, 'UTF-8', array(5, 5, 5, 5));
        $html2pdf->writeHTML($chaine);
        $html2pdf->output($filename); // 'F' to save to file
		$html2pdf->output($filename,'F');
    } catch (Html2PdfException $e) {
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
    }	