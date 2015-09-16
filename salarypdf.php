<?php
require('WriteHTML.php');

$pdf=new PDF_HTML();

$pdf->AliasNbPages();
$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 15);
$pdf->Image('assets/dist/img/header.png',17,10,170);
$pdf->SetFont('Arial','B',14);
$pdf->WriteHTML('<br><br><br><br><br><br><br><br>'); 
$pdf->WriteHTML('                                                      <h1 style="text-align: center;">Salary Statement</h1>  <br>  '); 

$pdf->SetFooterMargin(10);

$pdf->SetFont('Arial','B',7); 

$pdf->Image('assets/dist/img/watermarklogo.png',20,170,200);

/*$htmlTable='<br><br><br><br><br><hr><TABLE >
<TR>
<TD>Student Id [ '.$_POST["StundentId"].' ] </TD>
<TD>Student Name [ '.$_POST["FullName"].' ] </TD>
</TR>
<TR>
<TD>Affiliation [ '.$_POST['Affilation'].' ] </TD>
<TD>Job Title [ '.$_POST['JobTitle'].' ] </TD>
</TR>
<TR>
<TD>Join Date [ '.$_POST['StartJobDate'].' ] </TD>
<TD>Nationality [ '.$_POST['Nationality'].' ] </TD>
</TR>
<TR>
<TD>Basic Salary [ '.$_POST['BasicSalary'].' ] </TD>
<TD>Transportation [ '.$_POST['Transportation'].' ] </TD>
</TR>
<TR>
<TD>Other Allowance [ '.$_POST['OtherAllowence'].' ] </TD>
<TD></TD>
</TR>

</TABLE>';														
$pdf->WriteHTML2("<br><br><br>$htmlTable",20,20,170);*/

$pdf->SetFont('Arial','',10);
$pdf->SetMargins(15,0,0);
$pdf->WriteHTML('<br>'); 
//$pdf->SetTextColor(192,192,192);
/*$pdf->Cell(50,20,'Name:',1,0,'C',false,0);
$pdf->Cell(40,10,'Ali',1,0,'C');
$pdf->Cell(50,10,'Alis',1,0,'C');
$pdf->Cell(40,10,'Aliss',1,1,'C');

$pdf->Cell(50,10,'',0,0,'C');
$pdf->Cell(65,10,'Maths',1,0,'C');
$pdf->Cell(65,10,'Matshs',1,1,'C');*/

$pdf->Cell(90,15,$_POST["StundentId"],1,0,'R',false,0);
$pdf->Cell(90,15,$_POST["FullName"],1,1,'R');

$pdf->Cell(90,15,$_POST['Affilation'],1,0,'R',0);
$pdf->Cell(90,15,$_POST['JobTitle'],1,1,'R');

$pdf->Cell(90,15,$_POST['StartJobDate'],1,0,'R',0);
$pdf->Cell(90,15,$_POST['Nationality'],1,1,'R');

$pdf->Cell(90,15,$_POST['BasicSalary'],1,0,'R',0);
$pdf->Cell(90,15,$_POST['Transportation'],1,1,'R');

$pdf->Cell(180,15,$_POST['OtherAllowence'],1,0,'R',0);

$pdf->WriteHTML('<br><br><br><br><br><br><br>eury hkfhd,jfda,fsdkfd. <samp>تشهد المؤسسة العامة لتحلية المياه المالحة ( إدارة التشغيل والصيانة بالساحل الشرقي) أن

																	الموظف الواردة بياناته أدناه يعمل لديها وقد أعطي هذه الشهادة بناء على طلبه لتقديمها لمن 

																	يهمه الأمر دون مسئولية على المؤسسة.</samp>');

$pdf->Output(); 
?>