<?php
	header("Content-Type: application/PDF; charset=utf-8'");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=CPDList.pdf");
	if ($_REQUEST["aid"] >= 1)
	{
		$aid =$_REQUEST["aid"];
		$sqlx = mysql_query("SELECT * FROM activities WHERE ActivityID='".$aid."'");
		$rowx = mysql_fetch_array($sqlx);
			
		$start = date("z", strtotime($rowx["DateOfEvent"]));
		$end = date("z", strtotime($rowx["DateOfEnd"]));
		$totalDays = (int)$end-(int)$start;
		$sql = mysql_query("SELECT * FROM participants, staff, office, officecode where participants.aid=$aid AND staff.StaffID=participants.uid AND office.StaffID=staff.StaffID AND officecode.OfficeID=office.OfficeID GROUP BY participants.uid, staff.StaffID, office.StaffID ORDER BY officecode.OfficeID DESC");
	}
	$staffLen = 8;
	$nameLen = 35;
	$officeLen = 18;
	$dayLen = 3;
	$aChar = "H  ";
	$bChar = "TH ";
	//$aChar = "☑ ";
	//$bChar = "☐ ";
	$cChar = "✓ ";
	$dChar = "✔ ";
	
	$attrTable = "";
	$nameTable = "";
	//GENERATE attribute hari bermula disini
	for ($num = 0; $num <= $totalDays; $num++)
	{
		$attrTable .= "<td width=15>".($num+1)."</td>";
	}
	//EOL (END OF LINE)
	
	//GENERATE nama bermula disini
	while ($row = mysql_fetch_array($sql))
	{
		$nameTable .= "<TR><TD width=70>".$row["StaffID"]."</td><td width=300>".$row["Name"]."</td><td width=150>".$row["OfficeName"]."</td>";
		$tokenNum = 0;
		$StaffID = $row["StaffID"];
		$toklist = $row["state"];
		$tokens = ":";
		$arr = explode(':', $row["state"]);
		$nameTable .= "<td width=150><table width=150 border=1 cellspacing=0 cellpadding=0><TR>";
		foreach ($arr as $rx) {
			if ($rx == 1)
			{
				$nameTable .= "<TD width=15 align=center>".$aChar."</TD>";
			}
			else
			{
				$nameTable .= "<TD width=15 align=center>".$bChar."</TD>";
			}
		}
		$nameTable .= "</TR></table></TD></tr>";
	}
	//EOL
	
$content = '
<p align=center><b>SENARAI PESERTA UNTUK BORANG CPD<BR>'.$rowx["Name"].'</b></p>
<table width="680" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td width="70" align="left" rowspan=2><strong>NO STAF</strong></td>
    <td width="300" align="left" rowspan=2><strong>NAMA</strong></td>
    <td width="150" align="left" rowspan=2><strong>PTJ</strong></td>
    <td width="150" align="left"><strong>HARI</strong></td>
</tr>
<tr>
    <td width="150" align="center"><table width=150 border=1 cellspacing="0" cellpadding="0"><tr>'.$attrTable.'</tr></table></td>
  </tr>'.$nameTable.'
</table>
<p>&nbsp;</p>
<p>H&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Hadir<br>TH&nbsp;&nbsp;- Tidak Hadir</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Disahkan oleh,</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>______________________</p>
';
?>
<?php
include "pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);

$html2pdf->Output('suratcpd.pdf');

?>