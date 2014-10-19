<?php
	//header("Content-Type: application/vnd.ms-word; charset=utf-8'");
	header("Content-Type: application/vnd.ms-word; charset=utf-8'");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=AttendanceList.doc");
	if ($_REQUEST["aid"] >= 1)
	{
		$aid =$_REQUEST["aid"];
		$sqlx = mysql_query("SELECT * FROM activities WHERE ActivityID='".$aid."'");
		$rowx = mysql_fetch_array($sqlx);
			
		$start = date("z", strtotime($rowx["DateOfEvent"]));
		$end = date("z", strtotime($rowx["DateOfEnd"]));
		$totalDays = (int)$end-(int)$start;
		$sql = mysql_query("SELECT * FROM participants, staff, office, officecode where participants.aid=$aid AND staff.StaffID=participants.uid AND office.StaffID=staff.StaffID AND officecode.OfficeID=office.OfficeID GROUP BY participants.uid, staff.StaffID, office.StaffID ORDER BY officecode.OfficeID DESC");
		$sql2 = mysql_query("SELECT * FROM participants, studentdetails where participants.aid=$aid AND studentdetails.UserID=participants.uid GROUP BY studentdetails.UserID");
	}
	$staffLen = 8;
	$nameLen = 35;
	$officeLen = 18;
	$dayLen = 3;
	$aChar = "☑ ";
	$bChar = "☐ ";
	$cChar = "✓ ";
	$dChar = "✔ ";
	
	
	$text = "SENARAI PESERTA UNTUK BORANG KEHADIRAN ".$rowx["Name"]."\r\n";
	echo $text;
	echo strline($text);
	echo "\r\n";
	echo "HARI\t\t: ".$_REQUEST["day"]."\r\n";
	echo "\r\n";
	echo "\r\n";
	$defaultPTJ = "";
	while ($row = mysql_fetch_array($sql))
	{
		if ($defaultPTJ != $row["OfficeName"])
		{
			$defaultPTJ = $row["OfficeName"];
			echo "PEJABAT : ".$row["OfficeName"]."\r\n";
			echo space("NO STAF",$staffLen).space("NAMA PENUH",$nameLen);
			echo "\r\n";
		}
		echo space($row["StaffID"],$staffLen).space($row["Name"],$nameLen);
		echo "\r\n";
		echo space("",$staffLen+$nameLen+$officeLen)."___________\r\n";
		echo "\r\n";
	}
	echo "\r\n";
	echo "\r\n";
	echo strline($text);
	echo "\r\n";
	echo "HARI\t\t: ".$_REQUEST["day"]."\r\n";
	echo "\r\n";
	echo "\r\n";
	echo space("NO MATRIK",$staffLen+3).space("NAMA PENUH",$nameLen).space("TAHUN/KURSUS FAKULTI",$officeLen);
	echo "\r\n";
	while ($row = mysql_fetch_array($sql2))
	{
		echo space($row["UserID"],$staffLen+3).space($row["Name"],$nameLen).space($row["Year"].$row["Course"]." ".$row["Faculty"],$officeLen);
		echo "\r\n";
		echo space("",$staffLen+$nameLen+$officeLen)."___________\r\n";
		echo "\r\n";
	}
?>
	