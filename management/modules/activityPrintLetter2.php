<?php
	$aid =$_REQUEST["aid"];
	$oid =$_REQUEST["oid"];
	//header("Content-Type: application/vnd.ms-word; charset=utf-8'");

	header("Content-Type: application/vnd.ms-word");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	if ($_REQUEST["oid"] >= 1)
	{
		$sql = mysql_query("SELECT * FROM participants, staff, office, officecode, position, positioncode where participants.aid='".$aid."' AND participants.uid=staff.StaffID AND office.OfficeID='".$oid."' AND office.StaffID=staff.StaffID AND officecode.OfficeID=office.OfficeID AND position.StaffID=staff.StaffID AND positioncode.PosID=position.PosID GROUP BY staff.StaffID, office.StaffID, position.StaffID");
		//$sql = mysql_query("SELECT * FROM participants, staff, office, officecode, position, positioncode where participants.aid='".$aid."' AND participants.sid=staff.StaffID AND office.OfficeID='".$oid."' AND office.StaffID=staff.StaffID AND officecode.OfficeID=office.OfficeID AND position.StaffID=staff.StaffID AND positioncode.PosID=position.PosID GROUP BY staff.StaffID, office.StaffID, position.StaffID");
	}
	
	header("content-disposition: attachment;filename=SuratKeduaA".$aid."PTJ".$oid.".doc");
	echo "Salinan kepada\r\n";
	$num = 0;
	if ($sql)
	{
		while ($row = mysql_fetch_array($sql))
		{
			if ($num == 0)
			{
				$namePTJ = trim(strName($row["OfficeName"]));
				if (strlen($namePTJ) <= 5)
				{
					$namePTJ = strtoupper($namePTJ);
				}
				$namePTJ = str_replace("Pej ", "Pejabat ", $namePTJ);
				$namePTJ = str_replace(" Hepa", " HEPA", $namePTJ);
				echo "Staf-staf ".trim(strName($namePTJ))."\r\n";
				echo "\r\n";
			}
			echo trim(strName($row["Name"]))."\r\n";
			$num++;
		}
	}
?>