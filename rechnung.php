<?php
$bestell_datum = date("d.m.Y");
$tnextfriday = strtotime("next Friday");
$liefer_datum = date("d.m.Y", $tnextfriday);
$bestell_nummer = date("Ymd")."_Bestellung_Weissig2011";
$pdfAuthor = "vermietung@weissig2011.de";
$PDF_MARGIN_BOTTOM = 20;

$rechnungs_header = '
<img src="logo.jpg">
Weissig 2011 e.V.
Hauptstrasse 8a';

$rechnungs_footer = nl2br("Wir bitten um Lieferung bis maximal ".$liefer_datum." .\n Vielen Dank.\n\n Das Vereinshaus-Team.");

$filename = 'lager.json';
//$json = file_get_contents($filename);
//$data = json_decode($json);
$data = json_decode(file_get_contents('php://input'));
$pdfName = $bestell_nummer.".pdf";


//////////////////////////// Inhalt des PDFs als HTML-Code \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


// Erstellung des HTML-Codes. Dieser HTML-Code definiert das Aussehen eures PDFs.
// tcpdf unterstützt recht viele HTML-Befehle. Die Nutzung von CSS ist allerdings
// stark eingeschränkt.

$html = '
<table cellpadding="3" cellspacing="0" style="width: 100%; ">
	<tr>
            <td>'.nl2br(trim($rechnungs_header)).'</td>
            <td> </td>    
            <td style="text-align: right">Bestelldatum: '.$bestell_datum.'<br>
            </td>
            </tr>
	<tr>
        <td style="font-size:1.3em; font-weight: bold;">
<br><br>
Bestellung Vereinshaus
<br>
 </td>
</tr>
</table>
<br>

<table cellpadding="3" cellspacing="0" style="width: 100%; border-collapse:collapse;" table-striped border="0">
	<tr style="background-color: #cccccc; padding:5px;">
		<td style="padding:5px;"><b>Bezeichnung</b></td>
		<td style="text-align: center;"><b>Menge</b></td>
		
	</tr>';
			
	
foreach($data as $posten) {
	$menge = $posten->soll - $posten->ist;
        if ($menge == "0") {
            continue;
        }
	$html .= '<tr style="border-bottom: 1px solid black;">
                <td>'.$posten->artikel.'</td>
				<td style="text-align: center;">'.$menge.'</td>		
				
              </tr>';
}
$html .="</table>";



$html .= '
<br><hr><p>&nbsp;</p>'.$rechnungs_footer;






//////////////////////////// Erzeugung eures PDF Dokuments \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

// TCPDF Library laden
require_once('tcpdf/tcpdf.php');

// Erstellung des PDF Dokuments
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Dokumenteninformationen
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($pdfAuthor);
$pdf->SetTitle('Rechnung '.$rechnungs_nummer);
$pdf->SetSubject('Rechnung '.$rechnungs_nummer);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);

// Header und Footer Informationen
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Auswahl des Font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Auswahl der MArgins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Automatisches Autobreak der Seiten
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Image Scale 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Schriftart
$pdf->SetFont('dejavusans', '', 10);

// Neue Seite
$pdf->AddPage();

// Fügt den HTML Code in das PDF Dokument ein
$pdf->writeHTML($html, true, false, true, false, '');

//Ausgabe der PDF

//Variante 1: PDF direkt an den Benutzer senden:
//$pdf->Output($pdfName, 'I');

//Variante 2: PDF im Verzeichnis abspeichern:
$pdfPfad = dirname(__FILE__).'/'.$pdfName;
$pdf->Output($pdfPfad, 'F');
echo $pdfName;

//$dateien = array($pdfPfad);
//mail("admin@pfeiffer-privat.de", "Bstellung Vereinshaus", "Euer Nachrichtentext", "Absendername", "absender@domain.de", "antwortadresse@domain.de", $dateien);

?>
