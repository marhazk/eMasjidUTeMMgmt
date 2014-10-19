<?php
include "surat/surat1.php";
$content = $contents;
?>
<?php
include "pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);

$html2pdf->Output('exemple.pdf');

?>