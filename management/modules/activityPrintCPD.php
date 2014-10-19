<?php
	//header("Content-Type: application/vnd.ms-word; charset=utf-8'");
	header("Content-Type: application/vnd.ms-word; charset=utf-8'");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=CPDList.doc");
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
	$aChar = "☑ ";
	$bChar = "☐ ";
	$cChar = "✓ ";
	$dChar = "✔ ";
	
	$text = "SENARAI PESERTA UNTUK BORANG CPD ".$rowx["Name"]."\r\n";
	echo $text;
	echo strline($text);
	echo "\r\n";
	echo space("NO STAF",$staffLen).space("NAMA PENUH",$nameLen).space("PTJ",$officeLen);
	for ($num = 0; $num <= $totalDays; $num++)
	{
		echo space("D".($num+1),$dayLen);
	}
	echo "\r\n";
	while ($row = mysql_fetch_array($sql))
	{
		echo space($row["StaffID"],$staffLen).space($row["Name"],$nameLen).space($row["OfficeName"],$officeLen);
		$tokenNum = 0;
		$StaffID = $row["StaffID"];
		$toklist = $row["state"];
		$tokens = ":";
		$arr = explode(':', $row["state"]);
		foreach ($arr as $rx) {
			if ($rx == 1)
			{
				echo space($aChar,$dayLen);
			}
			else
			{
				echo space($bChar,$dayLen);
			}
		}
		echo "\r\n";
	}
	echo "\r\n";
	echo "\r\n";
	echo "Disahkan oleh,\r\n";
	echo "\r\n";
	echo "\r\n";
	echo "___________________\r\n";
?>