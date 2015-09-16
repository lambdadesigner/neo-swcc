<?php
require('WriteHTML.php');

$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 15);
$pdf->Image('assets/dist/img/header.png',20,20,170);
$pdf->SetFont('Arial','B',14);

$pdf->WriteHTML('                                                      <h1 style="text-align: center;">Medical Certificate</h1>  <br>  '); 

$pdf->SetFont('Arial','B',7); 

$pdf->Image('assets/dist/img/watermarklogo.png',120,170,200);

$htmlTable='<br><br><br><br><br><hr><TABLE >




<TR>
<TD>National Id [ '.$_POST["NationalId"].' ]</TD>
<TD>Student Id [ '.$_POST["StudentId"].' ]</TD>
</TR>
<TR>
<TD>Student Name [ '.$_POST['StudentName'].' ]</TD>
<TD>Issue Date [ '.$_POST['IssueDateM'].' ]</TD>
</TR>
<TR>
<TD>Job Title [ '.$_POST['JobTitle'].' ]</TD>
<TD>Signature [ '.$_POST['MSignature'].' ]</TD>
</TR>

</TABLE>';

														
$pdf->WriteHTML2("<br><br><br>$htmlTable");
$pdf->SetFont('Arial','B',6);
$pdf->Output(); 
?>