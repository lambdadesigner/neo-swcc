<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetAutoPageBreak(true, 15);

$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 15);

$pdf->SetFont('aealarabiya','',12); 
$pdf->Image('../assets/dist/img/white-background.png',1,10,200);
$pdf->Image('../assets/dist/img/header.png',15,10,170);
//$pdf->SetFont('Arial','B',14);
$pdf->WriteHTML('<br><br><br><br><br><br><br><br>'); 
$pdf->WriteHTML('                                                      <h3 style="text-align: center;">تعريف شهادة</h3>   '); 

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
$pdf->WriteHTML('اعتماد تذكرة الداخلي للطلاب السعوديين طلب');  

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

$pdf->setRTL(true);
$tbl11 = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <tr>
        <td style="padding:10px;" colspan="3">وأننى اتعهد بعدم إساءة إستخدام التذاكر أو بيعها أو منحها لأحد من أفراد أسرتى او لشخص أخر و أقر بعلمي أن أى إخلال منى بهذا التعهد أو بالشروط المدونه أسفل هذا النموذج سوف يترتب عليه حرماني من أى تذاكر مخفضة وأتحمل مسئولية لذا أمل التصديق على هذا الإقرار حتى اتمكن من الحصول على التخفيض الممنوح للطلبة أثناء سفرهم داخل المملكة بواقع ٥۰ النتائج المترتبه على ذلك. % من السعر. درجة الضيافة.</td>
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
        <td style="padding:10px;" colspan="3">السادة مكتب مبيعات السعودية فى مدينة / الجبيل بالرجوع إلى سجلاتنا إتضح بأن المذكور أعلاه أحد الطلبة المنتظمين فى مركز التدريب بالجبيل للعام الدراسي : وفى حالة ثبوت عدم صحة البيانات المدونه للمستفيد الموضحه بياناته أعلاه فإننى أتحمل المسئوليه كاملة والنتائج القانونية المترتبة على بذلك. لذا فقد تم التصديق على هذا الإقرار لإصدار التذكرة المخفضة وإستحصال المبلغ المستحق من المستفيد نقدا. وعلى هذا تم التوقيع</td>
    </tr>
    <tr>
        <td>مدير في اسم المسؤول</td>
        <td>$fIncharge</td>
        <td rowspan="4">الختم الرسمي</td>
    </tr>
    <tr>
        <td>المسمى الوظيفي </td>
        <td>$jTitle</td>
    </tr>
    <tr>        
        <td>توقيع </td>
        <td>$fSign</td>
    </tr>
    <tr>
        <td>تاريخ</td>
        <td>$fDate</td>
    </tr>    
</table>
EOD;
$pdf->writeHTML($tbl12, true, false, false, false, '');

$tbl13 = <<<EOD
<table cellspacing="0" cellpadding="5">
    <tr>
        <td style="padding:10px;" border="1">يعتمد أصل النموذج فقط على أن يكون موقع ومعتمد من المدير المسئول ووضع الختم الخاص بالجهه المصدره للشهاده. يقتصر هذا النموذج على الطلبة / الطالبات الذين يبلغ أعمارهم الثانية عشر وحتى التاسعة والعشرين هجريا فقط. يعتمد صلاحية التوقيع على النموذج من عمداء شئون الطلبة / الطالبات بالكليات والجامعات ومديرى المدارس والمراكز والمعاهد أو من ينوب لاينطبق هذا التخفيض على الموظفين المتدربين الذين يتلقون دورات تدريبية فى المراكز والمعاهد والكليات الحكومية والاهلية والعسكرية. شروط عامة إرفاق صورة من بطاقة الأحوال المدنية / بطاقة العائلة مع شهادة التعريف. تدفع قيمة التذكره نقدا أو بموجب بطاقة الإئتمان المعتمده من قبل الخطوط السعودية. الطالب المستفيد من التخفيض لايعمل فى أى جهه حكومية أو أهلية أو عسكرية. يجب إبراز أصل بطاقة العائلة عند شراء التذكرة. النموذج صالح لمدة شهرين من تاريخه ولشخص واحد فقط. عنهم.</td>
    </tr>
    <tr>
        <td border="0" align="left">لقد قرأت الشروط أعلاه</td>
    </tr>
    <tr>
        <td border="0" align="left">:اسم المستفيد</td>
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

$pdf->WriteHTML('<br><br><br><br>'); 
$pdf->Cell(60,5,'تعلق:',0,0,'L',false,0);
$pdf->Cell(60,5,'تاريخ:',0,0,'L',0);
$pdf->Cell(60,5,'المرجع:',0,0,'L',0);

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
