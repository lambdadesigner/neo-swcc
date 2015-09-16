<?php
require('WriteHTML.php');
$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
//$pdf->Image('logo.png',18,13,33);
$pdf->SetFont('Arial','B',14);
$pdf->WriteHTML('<para><h1>Medical Chechup Letter</h1><br></para>');

$pdf->SetFont('Arial','B',7); 
$target_path = "uploads/";

//$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
//move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);

$htmlTable='<TABLE>
<TR>
<TD>First Name:</TD>
<TD>'.$_POST["Firstname"].'</TD>
</TR>
<TR>
<TD>Last Name</TD>
<TD>'.$_POST['lastname'].'</TD>
</TR>
<TR>
<TD>Company Name</TD>
<TD>'.$_POST['companyname'].'</TD>
</TR>
<TR>
<TD>Company Address</TD>
<TD>'.$_POST['companyaddress'].'</TD>
</TR>


</TABLE>';
$pdf->WriteHTML2("<br><br><br>$htmlTable");
$pdf->SetFont('Arial','B',6);
$pdf->Output(); 



?>