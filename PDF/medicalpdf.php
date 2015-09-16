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
$pdf->WriteHTML('<br><br><br><br><br><br><br><br>'); 
$pdf->WriteHTML('                                                      <h3 style="text-align: center;">Medical Leave</h3>   '); 

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
$pdf->Cell(180,12,'Plant Department',0,0,'C',false,0);
$pdf->WriteHTML('');  

$pdf->SetFont('dejavusans', '', 9);
/*$pdf->Cell(180,12,$_POST["NationalId"],1,1,'R',false,0);

$pdf->Cell(90,12,$_POST["IssueDate"],1,0,'R',0);
$pdf->Cell(90,12,$_POST["IssuePlace"],1,1,'R');

$pdf->Cell(180,12,$_POST["FYear"],1,1,'R',0);

$pdf->Cell(90,12,$_POST["StudentId"],1,0,'R',0);
$pdf->Cell(90,12,$_POST["BirthDate"],1,1,'R');*/

// $fDate = $_POST["FDate"];
// $fName = $_POST["FName"];
// $fSign = $_POST["FSignature"];

//$pdf->setRTL(true);

$national = $_POST["NationalId"];
$stuId = $_POST["StudentId"];
$stuName = $_POST['StudentName'];
$jobTitle = $_POST['MJobTitle'];
$MSign = $_POST['MSignature'];
$IDate = $_POST['IssueDateM'];

$tbl11 = <<<EOD
<table cellspacing="0" cellpadding="5" border="1" width="1000">    
    <tr>        
        <td rowspan="2" width="20" height="40"></td>
        <td width="120" height="40">No</td>
        <td width="120" height="40">$national</td>
        <td width="120" height="40">Name</td>
        <td width="120" height="40">$stuName</td>
        <td rowspan="2" width="20" height="40"></td>
    </tr>
    <tr>
        <td width="120" height="40">No</td>
        <td width="120" height="40">$stuId</td>
        <td width="120" height="40">Job</td>
        <td width="120" height="40">$jobTitle</td>
    </tr>
    <tr>
        <td width="20" height="30"></td>
        <td colspan="4" width="480" height="30">We hope the medical examination on the question, and let us know the result.    
PLEASE ARRANGE A MEDICAL CHECKUP FOR THE ABOVE EMPLOYEE AND ADVICE US OF THE RESULT.

<br/><br/>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$jobTitle &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


No

<br/><br/>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  $MSign
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

$IDate

</td>
        <td width="20" height="30"></td>
    </tr>
    <tr>
        <td width="20"></td>        
        <td colspan="4"></td>
        <td width="20"></td>
    </tr>

</table>
EOD;
$pdf->writeHTML($tbl11, true, false, false, false, '');

// Restore RTL direction
$pdf->setRTL(false);
// set font
$pdf->SetFont('dejavusans','', 11);
$pdf->SetMargins(15,0,15);
$pdf->WriteHTML('<br><br><br>'); 
// print newline
$pdf->Ln();

$pdf->WriteHTML('<br><br><br><br>'); 
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
