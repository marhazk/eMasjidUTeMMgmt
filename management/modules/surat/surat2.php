<?php
	//header("Content-Type: application/vnd.ms-word; charset=utf-8'");
	if ($_REQUEST["aid"] >= 1)
	{
		$aid = $_REQUEST["aid"];
		$sqlx = mysql_query("SELECT * FROM activities WHERE ActivityID='".$aid."'");
		$rowx = mysql_fetch_array($sqlx);
			
		$start = date("z", strtotime($rowx["DateOfEvent"]));
		$end = date("z", strtotime($rowx["DateOfEnd"]));
		$totalDays = (int)$end-(int)$start;
		
		$start = date("z", strtotime($rowx["DateOfEvent"]));
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
		
		$timeEventStartFormatNum = date("G", strtotime($rowx["DateOfEvent"]));
		if ($timeEventStartFormatNum < 12)
			$timeEventStartFormat = "pagi";
		else if ($timeEventStartFormatNum == 12)
			$timeEventStartFormat = "tengah hari";
		else if ($timeEventStartFormatNum <= 18)
			$timeEventStartFormat = "petang";
		else if ($timeEventStartFormatNum < 23)
			$timeEventStartFormat = "malam";
		else
			$timeEventStartFormat = "tengah malam";
		$dateEventD = date("D", strtotime($rowx["DateOfEvent"]));
		$dateEventD = str_replace("Mon", "Isnin", $dateEventD);
		$dateEventD = str_replace("Tue", "Selasa", $dateEventD);
		$dateEventD = str_replace("Wed", "Rabu", $dateEventD);
		$dateEventD = str_replace("Thu", "Khamis", $dateEventD);
		$dateEventD = str_replace("Fri", "Jumaat", $dateEventD);
		$dateEventD = str_replace("Sat", "Sabtu", $dateEventD);
		$dateEventD = str_replace("Sun", "Ahad", $dateEventD);
		$timeEventStart = date("g:i", strtotime($row["DateOfEvent"])) ." ".$timeEventStartFormat;
		$dateEvent .= " ".$dateEventN." ".$dateEventYear." (".$dateEventD.")";
		
		
		$timeEventEndFormatNum = date("G", strtotime($rowx["DateOfEnd"]));
		if ($timeEventEndFormatNum < 12)
			$timeEventEndFormat = "pagi";
		else if ($timeEventEndFormatNum == 12)
			$timeEventEndFormat = "tengah hari";
		else if ($timeEventEndFormatNum <= 18)
			$timeEventEndFormat = "petang";
		else if ($timeEventEndFormatNum < 23)
			$timeEventEndFormat = "malam";
		else
			$timeEventEndFormat = "tengah malam";
		$dateEventD = date("D", strtotime($rowx["DateOfEnd"]));
		$dateEventD = str_replace("Mon", "Isnin", $dateEventD);
		$dateEventD = str_replace("Tue", "Selasa", $dateEventD);
		$dateEventD = str_replace("Wed", "Rabu", $dateEventD);
		$dateEventD = str_replace("Thu", "Khamis", $dateEventD);
		$dateEventD = str_replace("Fri", "Jumaat", $dateEventD);
		$dateEventD = str_replace("Sat", "Sabtu", $dateEventD);
		$dateEventD = str_replace("Sun", "Ahad", $dateEventD);
		//$timeEventEnd = date("g:i", strtotime($row["DateOfEnd"])) ." ".$timeEventEndFormat." (".$dateEventD.")";
		$timeEventEnd = date("g:i", strtotime($row["DateOfEnd"])) ." ".$timeEventEndFormat." (".$dateEventD.")";
		
		
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

    $totalUsers = 0;
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
		if ($ptj[enable] == 1)
		{
			$sql = mysql_query("SELECT * FROM participants, staff, office, officecode, position, positioncode where participants.aid='".$aid."' AND participants.uid=staff.StaffID AND office.OfficeID='".$ptj[id]."' AND office.StaffID=staff.StaffID AND officecode.OfficeID=office.OfficeID AND position.StaffID=staff.StaffID AND positioncode.PosID=position.PosID GROUP BY staff.StaffID, office.StaffID, position.StaffID");
			$osql = mysql_query("SELECT * FROM officecode where OfficeID='".$ptj[id]."'");
			$row = mysql_fetch_array($osql);
			$output .= "<tr><td width=750>";
			while ($rrow = mysql_fetch_array($sql))
			{
				$output .= trim(strName($rrow["Name"]))."<BR>";
			}
			$output .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Melalui dan salinan,</i><BR>";
			$namePTJ = trim(strName($row["OfficeName"]));
			$salinanPTJ = trim(strName($row["Salinan"]));
			if (strlen($namePTJ) <= 5)
			{
				$namePTJ = strtoupper($namePTJ);
			}
			$namePTJ = str_replace("Pej ", "Pejabat ", $namePTJ);
			$namePTJ = str_replace(" Hepa", " HEPA", $namePTJ);
			$output .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$salinanPTJ.", ".$namePTJ."<BR>"."<BR>";
			$output .= "</td></tr>";
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
        <td width="550" align="left" valign="middle"><p>Ruj. Kami (Our Ref)&nbsp;:&nbsp;UTeM. 13.01/100-14/12/1  ('.hspace(5).')<br>Ruj. Tuan (Your Ref) :</p></td>
        <td width="200" align="left"><p>'.$datePrint.'</p></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>
<table width="650" border="0" cellspacing="20" cellpadding="60">
'.$output.'
<tr><td width=650><img src="modules/surat/image003.png"/>
</td></tr><tr><td width=650>
Tuan/ Puan,
<p><strong>JEMPUTAN PENYERTAAN STAF KE '.trim($rowx["Name"]).'</strong></p>
</td></tr><tr><td width=650>
Dengan segala hormatnya, merujuk perkara di atas.
<p>2.'.hspace(10).'Adalah dimaklumkan bahawa, Pusat Islam UTeM dengan kerjasama Masjid Sayyidina Abu Bakar UTeM akan menganjurkan '.trim($rowx["Name"]).' pada ketetapan berikut :</p>
<p>'.hspace(12).'2.1 '.hspace(9).'Tarikh'.hspace(10).''.hspace(10).': '.hspace(5).'<strong>'.$dateEvent.'</strong><br />
  '.hspace(12).'2.2'.hspace(10).'Tempat'.hspace(18).': '.hspace(5).'<strong>'.trim($rowx["Location"]).'</strong><br />
  '.hspace(12).'2.3 '.hspace(9).'Masa'.hspace(11).''.hspace(10).': '.hspace(5).'<strong>'.$timeEventStart.'</strong> – <strong>'.$timeEventEnd.'</strong><br />
'.hspace(12).'2.4'.hspace(10).'Program'.hspace(16).': '.hspace(5).'<strong>'.trim($rowx["Name"]).'</strong></p>
</td></tr><tr><td width=650>
  3.     '.hspace(10).' Sehubungan itu, tuan/puan yang telah dijemput untuk hadir pada majlis tersebut. Kehadiran tuan/puan yang telah dipilih adalah diwajibkan. Sebarang pertanyaan sila berhubung dengan Encik Mohd Nawawi bin Muhamad atau Ustazah Syamilah binti Mohd Ali, sambungan 3316268/555 2017 atau email nawawi@utem.edu.my / syamilah@utem.edu.my . Bersama – sama ini dilampirkan aturcara program untuk makluman tuan/puan.
<p>Kerjasama tuan/puan dalam hal ini amatlah dihargai dan didahului dengan ucapan terima kasih.</p>
<p>Sekian,wassalam.</p>
<p><strong>&quot; DAKWAH PEMANGKIN KHAIRA UMMAH &quot;<br />
  &quot; KOMPETENSI TERAS KEGEMILANGAN &quot;</strong><br />
</p>
</td></tr><tr><td width=650>
<p>Saya yang menjalankan tugas,<br />
</p>
<p>&nbsp;</p>
<p><strong>DR RADZUAN BIN NORDIN</strong><br />
  Pengarah<br />
  Pusat Islam<br />
Universiti Teknikal Malaysia Melaka</p>
<p></p>

	</td></tr>
	</table></p>
	
';
?>
<?php
include "pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);

$html2pdf->Output('surat2.pdf');

?>