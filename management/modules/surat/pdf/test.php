<?php
ob_start();
?>
test
<?php
$getdata = ob_get_contents();
ob_get_flush();
?>

<?php
include "pdf/html2fpdf.php";
$html = $getdata;
$html2pdf = new FPDF('P','A4','fr');
$html2pdf->WriteHTML($html);

$html2pdf->Output('exemple.pdf');

?>