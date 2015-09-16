<?php
require('WriteHTML.php');

$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 15);
$pdf->Image('assets/dist/img/header.png',20,20,170);
$pdf->SetFont('Arial','B',14);

$pdf->WriteHTML('                                                      <h1 style="text-align: center;">Flight Discount</h1>  <br>  '); 

$pdf->SetFont('Arial','B',7); 

$pdf->Image('assets/dist/img/watermarklogo.png',120,170,200);

$htmlTable='<br><br><br><br><br><hr><TABLE >




<TR>
<TD>Natonal Id [ '.$_POST["NationalId"].' ]</TD>
<TD>Issue Date [ '.$_POST["IssueDate"].' ]</TD>
</TR>
<TR>
<TD>Issue Place [ '.$_POST['IssuePlace'].' ]</TD>
<TD>Year [ '.$_POST['FYear'].' ]</TD>
</TR>
<TR>
<TD>Student Id [ '.$_POST['StudentId'].' ]</TD>
<TD>Birth Date [ '.$_POST['BirthDate'].' ]</TD>
</TR>
<TR>
<TD>Date [ '.$_POST['FDate'].' ]</TD>
<TD>Student Name [ '.$_POST['FName'].' ]</TD>
</TR>
<TR>
<TD>Signature [ '.$_POST['FSignature'].' ]</TD>
<TD>Incharge [ '.$_POST['FIncharge'].' ]</TD>
</TR>
<TR>

<TD>Job Title [ '.$_POST['FJobTitle'].' ]</TD>
<TD></TD>
</TR>


</TABLE>';

														
$pdf->WriteHTML2("<br><br><br>$htmlTable");
$pdf->SetFont('Arial','B',6);
$pdf->Output(); 
?>