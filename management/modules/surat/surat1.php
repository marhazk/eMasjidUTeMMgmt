<?php
	//header("Content-Type: application/vnd.ms-word; charset=utf-8'");
	if ($_REQUEST["aid"] >= 1)
	{
		$aid =$_REQUEST["aid"];
		$sqlx = mysql_query("SELECT * FROM activities WHERE ActivityID='".$aid."'");
		$rowx = mysql_fetch_array($sqlx);
			
		$start = date("z", strtotime($rowx["DateOfEvent"]));
		$end = date("z", strtotime($rowx["DateOfEnd"]));
		$totalDays = (int)$end-(int)$start;
		
		$start = date("z", strtotime($row["DateOfEvent"]));
		$dateEvent = date("d", strtotime($rowx["DateOfEvent"]));
		$dateEventYear = date("Y", strtotime($rowx["DateOfEvent"]));
		$dateEventN = date("n", strtotime($rowx["DateOfEvent"]));
		$dateEventN = str_replace("12", "Disember", $dateEventN);
		$dateEventN = str_replace("11", "November", $dateEventN);
		$dateEventN = str_replace("10", "Oktober", $dateEventN);
		$dateEventN = str_replace("9", "September", $dateEventN);
		$dateEventN = str_replace("8", "Ogos", $dateEventN);
		$dateEventN = str_replace("7", "Julai", $dateEventN);
		$dateEventN = str_replace("6", "Jun", $dateEventN);
		$dateEventN = str_replace("5", "Mei", $dateEventN);
		$dateEventN = str_replace("4", "April", $dateEventN);
		$dateEventN = str_replace("3", "Mac", $dateEventN);
		$dateEventN = str_replace("2", "Febuari", $dateEventN);
		$dateEventN = str_replace("1", "Januari", $dateEventN);
		
		$timeEventFormatNum = date("G", strtotime($rowx["DateOfEvent"]));
		if ($timeEventFormatNum < 12)
			$timeEventFormat = "pagi";
		else if ($timeEventFormatNum == 12)
			$timeEventFormat = "tengah hari";
		else if ($timeEventFormatNum <= 18)
			$timeEventFormat = "petang";
		else if ($timeEventFormatNum < 23)
			$timeEventFormat = "malam";
		else
			$timeEventFormat = "tengah malam";
		$dateEventD = date("D", strtotime($rowx["DateOfEvent"]));
		$dateEventD = str_replace("Mon", "Isnin", $dateEventD);
		$dateEventD = str_replace("Tue", "Selasa", $dateEventD);
		$dateEventD = str_replace("Wed", "Rabu", $dateEventD);
		$dateEventD = str_replace("Thu", "Khamis", $dateEventD);
		$dateEventD = str_replace("Fri", "Jumaat", $dateEventD);
		$dateEventD = str_replace("Sat", "Sabtu", $dateEventD);
		$dateEventD = str_replace("Sun", "Ahad", $dateEventD);
		$timeEvent = date("g:i", strtotime($row["DateOfEvent"])) ." ".$timeEventFormat;
		$dateEvent .= " ".$dateEventN." ".$dateEventYear." (".$dateEventD.")";
		
		
		$datePrint = date("g", time());
		$datePrintYear = date("Y", time());
		$datePrintN = date("n", time());
		$datePrintN = str_replace("12", "Disember", $datePrintN);
		$datePrintN = str_replace("11", "November", $datePrintN);
		$datePrintN = str_replace("10", "Oktober", $datePrintN);
		$datePrintN = str_replace("9", "September", $datePrintN);
		$datePrintN = str_replace("8", "Ogos", $datePrintN);
		$datePrintN = str_replace("7", "Julai", $datePrintN);
		$datePrintN = str_replace("6", "Jun", $datePrintN);
		$datePrintN = str_replace("5", "Mei", $datePrintN);
		$datePrintN = str_replace("4", "April", $datePrintN);
		$datePrintN = str_replace("3", "Mac", $datePrintN);
		$datePrintN = str_replace("2", "Febuari", $datePrintN);
		$datePrintN = str_replace("1", "Januari", $datePrintN);
		$datePrint .= " ".$datePrintN." ".$datePrintYear;
	}


	$tokenNum = 0;
	$arrNum = 0;
	$tokens = ":";
	$arrList = explode($tokens, $rowx["ptj"]);
	$output = "";
	$output2 = "";
	foreach ($arrList as $tokenized)
	{
		if ($tokenNum == 0)
			$ptjSalinan[$arrNum][id] = $tokenized;
		if ($tokenNum == 1)
			$ptjSalinan[$arrNum][enable] = $tokenized;
		if ($tokenNum == 2)
			$ptjSalinan[$arrNum][total] = $tokenized;
		if ($tokenNum == 3)
			$ptjSalinan[$arrNum][StaffID] = $tokenized;
		if ($tokenNum == 3)
		{
			$arrNum++;
			$tokenNum = 0;
		}
		else
			$tokenNum++;
	}
	$arrNum = 0;
	while ($arrNum < 20)
	{
		$ptj = $ptjSalinan[$arrNum];
		if (($ptj[enable] == 1) && ($ptj[StaffID] > 0))
		{
			$sql = mysql_query("SELECT * FROM staff, office, officecode, position, positioncode where staff.StaffID='".$ptj[StaffID]."' AND office.StaffID=staff.StaffID AND officecode.OfficeID=office.OfficeID AND position.StaffID=staff.StaffID AND positioncode.PosID=position.PosID GROUP BY staff.StaffID, office.StaffID, position.PosID LIMIT 0, 1");
			$row = mysql_fetch_array($sql);
			$output .= "<tr><td width=750>";
			if ($row["Name"] )
			$output .= trim(strName($row["Name"]))."<BR>";
			$output .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Melalui dan salinan,</i><BR>";
			$namePTJ = trim(strName($row["OfficeName"]));
			if (strlen($namePTJ) <= 5)
			{
				$namePTJ = strtoupper($namePTJ);
			}
			$namePTJ = str_replace("Pej ", "Pejabat ", $namePTJ);
			$namePTJ = str_replace(" Hepa", " HEPA", $namePTJ);
			$output .= hspace(10).trim(strName($row["PosName"])).", ".$namePTJ."<BR>"."<BR>";
			$output .= "</td></tr>";			
			
			$output2 .= "<tr><td width=50 border=1 height=30 align=center><font size=25>".($arrNum+1)."</font></td>";
			$output2 .= "<td width=400 border=1 height=30 align=left><font size=25>".trim(strtoupper($row["OfficeName"]))."</font></td>";
			$output2 .= "<td width=50 border=1 height=30 align=center><font size=25>".trim($ptj[total])."</font></td></tr>";
		}
		$arrNum++;
	}
$content = '
<table width="750" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150"><img src="modules/surat/image001.jpg" width="100"></td>
        <td width="600"><p align="left"><strong>UNIVERSITI TEKNIKAL MALAYSIA MELAKA</strong><br>
          Karung Berkunci No. 1752, Pejabat Pos Durian Tunggal,<br>
          76109 Durian  Tunggal, Melaka<br>
 Tel : 06-331 6304/6268 Faks : 06-331 6262</p>
          <p align="left">E-mel : <em>pusatislam@utem.edu.my</em></p></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><hr/></td>
  </tr>
  <tr>
    <td><table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr align="center">
        <td width="200"></td>
        <td width="350" valign="middle"><strong> PUSAT ISLAM</strong></td>
        <td width="200"><img src="modules/surat/sirim.jpg" width="69" height="47"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="750" border="0" cellspacing="0" cellpadding="0">
      <tr align="center">
        <td width="550" align="left" valign="middle"><p>Ruj. Kami (Our Ref)&nbsp;:&nbsp;UTeM.13.02/20.15/10/2 ('.hspace(5).')<br>Ruj. Tuan (Your Ref) :</p></td>
        <td width="200" align="left"><p>'.$datePrint.'</p></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>
<BR>
<BR>
<BR>
<table width="600" border="0" cellspacing="20" cellpadding="60">
'.$output.'
<tr><td width=600>
<p><img src="modules/surat/image003.png"/></p>
</td></tr><tr><td width=600>
Tuan/ Puan,
      <p><b>MEMOHON PENYERTAAN STAF KE '.strtoupper($rowx["Name"]).'</b></p>
</td></tr><tr><td width=600>
      Dengan segala hormatnya, saya merujuk perkara di atas.
      <p>2.'.hspace(15).'Adalah dimaklumkan bahawa Pusat Islam akan menganjurkan '.strName($rowx["Name"]).'. Di dalam program tersebut akan diadakan pengajian kitab bersama penceramah yang dilantik iaitu mengenai <b>&ldquo;'.strName($rowx["Name"]).'&rdquo;</b> peringkat universiti pada ketetapan berikut :-</p>
</td></tr><tr><td width=600>
      <p><b>'.hspace(30).'Tarikh&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:'.hspace(10).''.$dateEvent.'</b>
	  <BR><b>'.hspace(30).'Masa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:'.hspace(10).''.$timeEvent.'</b>
	  <BR><b>'.hspace(30).'Tempat &nbsp;&nbsp;&nbsp;:'.hspace(10).''.strName($rowx["Location"]).'</b></p>
	   
	   
</td></tr><tr><td width=600>
     3.'.hspace(15).'Sehubungan itu, Pusat Islam, UTeM memohon kepada  tuan/ puan dapat menghantar staf bagi sama-sama mengimarahkan majlis ilmu ini. Semoga  kita sentiasa mendapat ilmu yang bermanfaat dari majlis ini.
      <p>4.'.hspace(15).'Kerjasama tuan/ puan dalam hal ini amatlah dihargai dan  didahului dengan ucapan terima kasih.</p>
      <p><br>Sekian, Wassalam.</p>
      <p><b>&ldquo;DAKWAH PEMANGKIN KHAIRAH UMMAH&rdquo;</b><br>
        <b>&ldquo;KOMPETENSI TERAS KEGEMILANGAN&rdquo;</b></p>
</td></tr><tr><td width=600>
      <p>Saya yang menjalankan amanah,</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
<p>&nbsp;</p>
<p><strong>DR RADZUAN BIN NORDIN</strong><br />
  Pengarah<br />
  Pusat Islam<br />
Universiti Teknikal Malaysia Melaka</p>
<p>
<BR>
<BR></p>
	</td></tr>
	</table></p>
	
<p>
<table width="650" height="1000" border="0" cellspacing="0" cellpadding="0">
<tr><td height="1000" valign="top">
<table width="650" border="0" cellspacing="60" cellpadding="60">
<tr><td width=650 align=center>
<p><b>
SENARAI STAF PTJ YANG DIJEMPUT KE<BR>
'.strtoupper($rowx["Name"]).'
</b></p>
<P>
<table width="650" border="1" cellspacing="0" cellpadding="0">
<tr><td width=80 height=50 border=1 align=center cellspacing="35" cellpadding="10"><font size=30><B>BIL</B></font></td>
<td width=450 height=50  border=1 align=center cellspacing="35" cellpadding="10"><font size=30><B>PTJ</B></font></td>
<td width=80 height=50  border=1 align=center cellspacing="35" cellpadding="10"><font size=30><B>JUMLAH</B></font></td></tr>
	'.$output2.'
</table>
</p>
</td></tr>
</table>
</td></tr>
</table>
</p>
';
?>
<?php
include "pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);

$html2pdf->Output('surat1.pdf');

?>