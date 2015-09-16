<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 15);
$pdf->Image('../assets/dist/img/white-background.png',1,10,200);
$pdf->Image('../assets/dist/img/header.png',17,10,170);
//$pdf->SetFont('Arial','B',14);
$pdf->WriteHTML('<br><br><br><br><br><br><br><br>'); 
$pdf->WriteHTML('                                                      <h3 style="text-align: center;">Salary Statement</h3>  <br>  '); 

$pdf->SetFont('aealarabiya','',5); 

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
$pdf->SetFont('dejavusans', '', 9);
$pdf->SetMargins(15,0,0);
$pdf->WriteHTML('<br>'); 

$pdf->Cell(90,15,'$_POST["StundentId"]',1,0,'R',false,0);
$pdf->Cell(90,15,'$_POST["FullName"]',1,1,'R');

$pdf->Cell(90,15,'$_POST[Affilation]',1,0,'R',0);
$pdf->Cell(90,15,'$_POST[JobTitle]',1,1,'R');

$pdf->Cell(90,15,'$_POST[StartJobDate]',1,0,'R',0);
$pdf->Cell(90,15,'$_POST[Nationality]',1,1,'R');

$pdf->Cell(90,15,'$_POST[BasicSalary]',1,0,'R',0);
$pdf->Cell(90,15,'$_POST[Transportation]',1,1,'R');

$pdf->Cell(180,15,'$_POST[OtherAllowence]',1,0,'R',0);

// set LTR direction for english translation
//$pdf->setRTL(false);

// Restore RTL direction
$pdf->setRTL(true);
// set font
$pdf->SetFont('dejavusans','', 11);
$pdf->SetMargins(15,0,15);
$pdf->WriteHTML('<br><br><br><br>'); 

// print newline
$pdf->Ln();

$htmlcontent = 'تشهد المؤسسة العامة لتحلية المياه المالحة ( إدارة التشغيل والصيانة بالساحل الشرقي) أن

																	الموظف الواردة بياناته أدناه يعمل لديها وقد أعطي هذه الشهادة بناء على طلبه لتقديمها لمن 

																	يهمه الأمر دون مسئولية على المؤسسة.';
$pdf->WriteHTML($htmlcontent, true, 0, true, 0);
$pdf->WriteHTML('<br><br><br><br><br>'); 

$pdf->setRTL(false);
$pdf->Cell(90,5,'مشرف شئون المتدربين',0,0,'C',false,0);
$pdf->Cell(90,5,'الختم الرسمي',0,1,'C');

$pdf->Cell(90,5,'خالد بن عبد الله النعيم',0,0,'C',0);

$pdf->WriteHTML('<br><br><br><br><br><br><br>'); 
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
