<?php
	if ($_REQUEST["aid"] >= 1)
	{
		$aid =$_REQUEST["aid"];
		$sqlx = mysql_query("SELECT * FROM activities WHERE ActivityID='".$aid."'");
		$rowx = mysql_fetch_array($sqlx);
			
		$start = date("z", strtotime($rowx["DateOfEvent"]));
		$end = date("z", strtotime($rowx["DateOfEnd"]));
		$totalDays = (int)$end-(int)$start;
		
	}


	$tokenNum = 0;
	$arrNum = 0;
	$tokens = ":";
	$arrList = explode($tokens, $rowx["ptj"]);
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
		{
			$tokenNum++;
		}
	}
?><table width="100%%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>#</td>
    <td>PTJ</td>
    <td>Jumlah Peserta Yang Diperlukan</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  $arrNum = 0;
  	while ($arrNum < 20)
	{
		$ptj = $ptjSalinan[$arrNum];
		if ($ptj[enable] == 1)
		{
			$num++;
			$sqlo = mysql_query("SELECT * FROM officecode WHERE OfficeID='".$ptj[id]."'");
			$rowo = mysql_fetch_array($sqlo);
			$oid = $ptj[id];
?>
  <tr>
    <td><?php echo $num;?></td>
    <td><?php echo $rowo["OfficeName"];?></td>
    <td><?php echo $ptj[total];?></td>
    <td><a href="?op=activityPrintLetter2&amp;oid=<?php echo $ptj["id"];?>&amp;aid=<?php echo $aid;?>&header=1">Muat Turun Senarai Nama</a></td>
  </tr>
  <?php
  		}
		$arrNum++;
	}
?>
</table>
<p><a href="?op=activityinfo&aid=<?php echo $aid;?>">Kembali</a></p>
