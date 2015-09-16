<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 15);
$pdf->Image('../assets/dist/img/white-background.png',1,10,200);
$pdf->Image('../assets/dist/img/header.png',15,10,170);
//$pdf->SetFont('Arial','B',14);
$pdf->WriteHTML('<br><br><br><br><br><br><br>'); 
$pdf->WriteHTML('                                                      <h3 style="text-align: center;">Certificate Definition</h3>   '); 

$pdf->SetFont('aealarabiya','',18); 

$pdf->Image('../assets/dist/img/logo-bg1.png',20,150,200);

// set some language dependent data:
/*$lg = Array();
$lg['a_meta_charset'] = 'UTF-8';
$lg['a_meta_dir'] = 'rtl';
$lg['a_meta_language'] = 'fa';
$lg['w_page'] = 'page';

// set some language-dependent strings (optional)
$pdf->setLanguageArray($lg);*/

// set font
$pdf->SetMargins(15,0,15);

$pdf->WriteHTML('<br>'); 
$pdf->WriteHTML('The adoption of an internal ticket for students Saudis request');  

$pdf->SetFont('dejavusans', '', 9);
$pdf->Cell(180,12,$_POST["NationalId"],1,1,'R',false,0);

$pdf->Cell(90,12,$_POST["IssueDate"],1,0,'R',0);
$pdf->Cell(90,12,$_POST["IssuePlace"],1,1,'R');

$pdf->Cell(180,12,$_POST["FYear"],1,1,'R',0);

$pdf->Cell(90,12,$_POST["StudentId"],1,0,'R',0);
$pdf->Cell(90,12,$_POST["BirthDate"],1,1,'R');

$fDate = $_POST["FDate"];
$fName = $_POST["FName"];
$fSign = $_POST["FSignature"];

$pdf->setRTL(false);
$tbl11 = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <td style="padding:10px;" colspan="3">I pledge not to abuse the use of the ticket, sold or given to one of my family members or for another person and acknowledged my knowledge that any breach of Mona this pledge or conditions code bottom of this form will entail deprive me of any discount tickets and take responsibility therefore hope the ratification of this recognition so that I to get the reduction granted to the students as they travel within the Kingdom by 50 consequences. % Of the price. The degree of hospitality.</td>
    </tr>
    <tr>
        <td>$fDate</td>
        <td>$fName</td>
        <td>$fSign</td>
    </tr>
</table>
EOD;
$pdf->writeHTML($tbl11, true, false, false, false, '');

/*$pdf->Cell(60,15,'$_POST[BasicSalary]',1,0,'R',0);
$pdf->Cell(60,15,'$_POST[Transportation]',1,0,'R');
$pdf->Cell(60,15,'$_POST[Transportation]',1,1,'R');*/

$fIncharge = $_POST['FIncharge'];
$jTitle = $_POST['FJobTitle'];

$tbl12 = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <td style="padding:10px;" colspan="3">Gentlemen sales office in the Saudi city / Jubail by reference to our records it became clear that the above-mentioned one of the regular students at the training center in Jubail for the academic year: Should it not prove the data to the beneficiary's health code data described above then I bear full responsibility and legal consequences of this. So it has been the ratification of this recognition for the issuance of discount ticket and obtaining the amount owed by the beneficiary in cash. And on this was signed</td>
    </tr>
    <tr>
        <td>The manager in charge name</td>
        <td>$fIncharge</td>
        <td rowspan="4">Office Seal</td>
    </tr>
    <tr>
        <td>Job Title </td>
        <td>$jTitle</td>
    </tr>
    <tr>        
        <td>Signature </td>
        <td>$fSign</td>
    </tr>
    <tr>
        <td>Date</td>
        <td>$fDate</td>
    </tr>    
</table>
EOD;
$pdf->writeHTML($tbl12, true, false, false, false, '');

$tbl13 = <<<EOD
<table cellspacing="0" cellpadding="5">
    <tr>
        <td style="padding:10px;" border="1">The origin of the model depends only on the site and be certified by the Director in charge and put your seal issuer of the certificate. This model is limited to students / female students who reach the age of twelve and even twenty-ninth AH only. The signature on the form of the deans of student affairs / college and university students and the directors of the schools, centers and institutes or on behalf of the authority depends for this reduction does not apply to trained personnel who receive training in the centers and institutes and government civil and military colleges. General conditions attach a copy of the Civil Status / family card with the certificate. The value of the ticket paid in cash or by credit card accredited by Saudi Arabian Airlines. Student beneficiary of the reduction does not function in any government or civil or military face. You must present your card out of the family when you buy a ticket. Saleh model for a period of two months from that date and only one person. Them.</td>
    </tr>
    <tr>
        <td border="0" align="left">I have read the above conditions</td>
    </tr>
    <tr>
        <td border="0" align="left">:Beneficiary Name</td>
    </tr>
</table>
EOD;
$pdf->writeHTML($tbl13, true, false, false, false, '');

// set LTR direction for english translation
//$pdf->setRTL(false);

// Restore RTL direction
$pdf->setRTL(false);
// set font
$pdf->SetFont('dejavusans','', 11);
$pdf->SetMargins(15,0,15);

// print newline
$pdf->Ln();

$pdf->Cell(60,5,'Attach:',0,0,'L',false,0);
$pdf->Cell(60,5,'Date:',0,0,'L',0);
$pdf->Cell(60,5,'Ref:',0,0,'L',0);

$pdf->SetFont('helvetica', '', 8);
/*$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td rowspan="3">COL 1 - ROW 1<br />COLSPAN 3</td>
        <td>COL 2 - ROW 1</td>
        <td>COL 3 - ROW 1</td>
    </tr>
    <tr>
    	<td rowspan="2">COL 2 - ROW 2 - COLSPAN 2<br />text line<br />text line<br />text line<br />text line</td>
    	<td>COL 3 - ROW 2</td>
    </tr>
    <tr>
       <td>COL 3 - ROW 3</td>
    </tr>

</table>
EOD;*/
//$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('example_018.pdf', 'I');
