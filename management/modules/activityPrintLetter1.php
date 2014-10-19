<?php
	//header("Content-Type: application/vnd.ms-word; charset=utf-8'");
	header("Content-Type: application/vnd.ms-word");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=SuratPertama.doc");
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
			echo "Salinan kepada\r\n";
			echo trim(strName($row["Name"]))."\r\n";
			$namePTJ = trim(strName($row["OfficeName"]));
			if (strlen($namePTJ) <= 5)
			{
				$namePTJ = strtoupper($namePTJ);
			}
			$namePTJ = str_replace("Pej ", "Pejabat ", $namePTJ);
			$namePTJ = str_replace(" Hepa", " HEPA", $namePTJ);
			echo trim(strName($row["PosName"])).", ".$namePTJ."\r\n"."\r\n";
			//echo "<P>Salinan kepada\r\n";
			//echo $ptj[id]."\r\n";
			//echo "<P>".$ptj[id].",".$ptj[total].",".$ptj[StaffID].", ".$ptj[enable]."\r\n"."\r\n";
		}
		$arrNum++;
	}
?>