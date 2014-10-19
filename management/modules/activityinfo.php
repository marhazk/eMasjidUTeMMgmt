<?php
	include "modules/mail2ptj.php";
	$showform = 1;
	define ("FILEREPOSITORY","./poster/");
	if ($_POST["ey1"] >= 1)
	{
		$startDate		= $_POST["ey1"].addZero($_POST["em1"]).addZero($_POST["ed1"]).addZero($_POST["ehh1"]).addZero($_POST["emm1"]);
		$endDate		= $_POST["ey2"].addZero($_POST["em2"]).addZero($_POST["ed2"]).addZero($_POST["ehh2"]).addZero($_POST["emm2"]);
		$publishDate	= $_POST["ey3"].addZero($_POST["em3"]).addZero($_POST["ed3"]).addZero($_POST["ehh3"]).addZero($_POST["emm3"]);
		//die($startDate."-".$endDate."-".$publishDate);
		if ($startDate >= $endDate)
		{
			echo "<script>alert('Tarikh Tamat aktiviti tidak Sah. Sila rujuk kepada tarikh Mula aktiviti');</script>";
			echo "<script>window.history.go(-1);</script>";
			die();
		}
		if ($startDate <= $publishDate)
		{
			echo "<script>alert('Tarikh Tamat Pendaftaran aktiviti tidak Sah. Sila rujuk kepada tarikh Mula aktiviti');</script>";
			echo "<script>window.history.go(-1);</script>";
			die();
		}
		$sysStartTime = $publishDate;
		$sysCurrentTime = date('YmdGi', time());
		$dStart = date('l jS \of F Y h:i:s A', $sysStartTime);
		$dCurrent = date('l jS \of F Y h:i:s A', $sysCurrentTime);
		if (($sysStartTime-$sysCurrentTime) <= 0)
		{
			echo "<script>alert('Tarikh Tamat Pendaftaran Aktiviti tidak Sah. Sila rujuk tarikh terkini');</script>";
			echo "<script>window.history.go(-1);</script>";
			die();
		}
	}
	if ($_POST["chk"] == "Simpan")
	{
		$aid = $_POST["aid"];
		$ptjstatement = "";
	   $num = 0;
	   $query = mysql_query("SELECT * FROM officecode");
	   $ptjList = array();
	   while ($row = mysql_fetch_array($query))
		{
			// ID:AKTIF [0,1]:Bil Join:Salinan:
			$num++;
			$ptjstatement .= $num;
			//$ptjstatement .= ":";
			//if ($_POST["eaktif".$num] == 1)
			//	$ptjstatement .= $row["OfficeName"];
			$ptjstatement .= ":";
			$ptjstatement .= $_POST["eaktif".$num];
			$ptjstatement .= ":";
			$ptjstatement .= $_POST["enamex".$num];
			$ptjstatement .= ":";
			$ptjstatement .= $_POST["epartx".$num];
			$ptjstatement .= ":";
		}
		$studentreg = 0;
		if ($_POST["studentregval"] >= 1)
			$studentreg = $_POST["enameStudent"];
		$_POST["ename"] = strtoupper($_POST["ename"]);
		
		$sqlx = "UPDATE activities SET name='".$_POST["ename"]."',
			DateofEvent=".DATE("'".$_POST["ey1"]."-".$_POST["em1"]."-".$_POST["ed1"]." ".$_POST["ehh1"].":".$_POST["emm1"].":00'").",
			DateofEnd=".DATE("'".$_POST["ey2"]."-".$_POST["em2"]."-".$_POST["ed2"]." ".$_POST["ehh2"].":".$_POST["emm2"].":00'").",
			DateofPublish=".DATE("'".$_POST["ey3"]."-".$_POST["em3"]."-".$_POST["ed3"]." ".$_POST["ehh3"].":".$_POST["emm3"].":00'").",
			Description='".$_POST["edesc"]."',
			ImageURL='".$name."',
			Location='".$_POST["KodFakulti"]."',
			studentreg='".$studentreg."',
			staffreg='0',
			nonreg='".$_POST["epartno"]."',
			signedstaff='".$_POST["epartno2"]."',
			ptj='".$ptjstatement."',
			org='".strtoupper($_POST["eorg"])."',
			contactnum='".$_POST["econtact"]."' WHERE ActivityID='".$aid."'";
			//die($sqlx);
		$sql = mysql_query($sqlx);
		if ($sql)
		{
			echo "<P>Aktiviti telah berjaya dikemaskinikan.</P>";
			echo"<script> alert('Aktiviti telah berjaya dikemaskinikan.');</script>";
		}
		else
		{
			echo "<P>Aktiviti tidak berjaya dikemaskinikan.</P>";
			echo"<script> alert('Aktiviti tidak berjaya dikemaskinikan.');</script>";
		}
	}
	else if ($_REQUEST["chk"] == "Padam")
	{
		$sql = mysql_query("DELETE FROM activities WHERE ActivityID='".$_REQUEST["aid"]."'");
		$sql2 = mysql_query("DELETE FROM participants WHERE aid='".$_REQUEST["aid"]."'");
		if ($sql)
		{
			echo "<P>Aktiviti telah berjaya dipadamkan.</P>";
			echo"<script> alert('Aktiviti telah berjaya dipadamkan.');</script>";
			echo '<script> window.location = "?op=activitylist";</script>';
			die();
		}
		else
		{
			echo "<P>Aktiviti tidak berjaya dipadamkan.</P>";
			echo"<script> alert('Aktiviti tidak berjaya dipadamkan.');</script>";
			echo"<script> history.go(-1);</script>";
			die();
		}
	}
	elseif ($_POST["chk"] == "Daftar")
	{
		if ($_POST["ename"] == "")
		{
			echo"<script> alert('Nama Aktiviti tidak dimasukkan');</script>";
			echo"<script> history.go(-1);</script>";
			die();
		}
		$_POST["ename"] = strtoupper($_POST["ename"]);
	   if (is_uploaded_file($_FILES['ebanner']['tmp_name'])) {
	
			 $name = $_FILES['ebanner']['name'];
			 $result = move_uploaded_file($_FILES['ebanner']['tmp_name'], FILEREPOSITORY."/$name.jpg");
			 if ($result == 1) echo "<p>Banner berjaya disimpankan.</p></p>";
			 else echo "<p>Banner tidak berjaya disimpankan.</p>";
	
	   }
	   $ptjstatement = "";
	   $num = 0;
	   $query = mysql_query("SELECT * FROM officecode");
	   while ($row = mysql_fetch_array($query))
		{
			// ID:AKTIF [0,1]:Bil Join:Salinan:
			$num++;
			$ptjstatement .= $num;
			//$ptjstatement .= ":";
			//if ($_POST["eaktif".$num] == 1)
			//	$ptjstatement .= $row["OfficeName"];
			$ptjstatement .= ":";
			$ptjstatement .= $_POST["eaktif".$num];
			$ptjstatement .= ":";
			$ptjstatement .= $_POST["enamex".$num];
			$ptjstatement .= ":";
			$ptjstatement .= $_POST["epartx".$num];
			$ptjstatement .= ":";
			$ptjList[($num-1)] = $row["OfficeID"];
		}
		$studentreg = 0;
		if ($_POST["studentregval"] >= 1)
			$studentreg = $_POST["enameStudent"];
	   $sql = "INSERT INTO activities (name, DateofEvent, DateofEnd, DateofPublish, Description, ImageURL, Location, studentreg, staffreg, nonreg, signedstaff, ptj, org, contactnum) VALUES ('".$_POST["ename"]."',".DATE("'".$_POST["ey1"]."-".$_POST["em1"]."-".$_POST["ed1"]." ".$_POST["ehh1"].":".$_POST["emm1"].":00'").",".DATE("'".$_POST["ey2"]."-".$_POST["em2"]."-".$_POST["ed2"]." ".$_POST["ehh2"].":".$_POST["emm2"].":00'").",".DATE("'".$_POST["ey3"]."-".$_POST["em3"]."-".$_POST["ed3"]." ".$_POST["ehh3"].":".$_POST["emm3"].":00'").",'".$_POST["edesc"]."','".$name."','".$_POST["KodFakulti"]."','".$studentreg."','".$_POST["epartyes"]."','".$_POST["epartno"]."','".$_POST["epartno2"]."','".$ptjstatement."','".strtoupper($_POST["eorg"])."','".$_POST["econtact"]."');";
	   $qSQL = mysql_query($sql);
	   if ($qSQL)
	   {
			if (is_array($ptjList))
			{
				if ($_POST[sendEmail])
				{
					$sqlxa = "SELECT * FROM activities ORDER BY ActivityID DESC LIMIT 0, 1";
					$rowxa = mysql_fetch_array(mysql_query($sqlxa));
					$dateEvent = $_POST["ey1"]."-".$_POST["em1"]."-".$_POST["ed1"]." ".$_POST["ehh1"].":".$_POST["emm1"];
					foreach ($ptjList as $ptj)
					{
						if ($_POST["eaktif".$num] == 1)
							mail2PTJ($rowxa, $ptj, $_POST["ename"]);
					}
				}
			}
			echo "<P>Aktiviti telah didaftarkan</P>";
			echo "<script>alert('Aktiviti telah didaftarkan');</script>";
			$add = 1;
	   }
	   else
	   {
		   $showform = 0;
			echo "<P>Aktiviti tidak berjaya didaftarkan</P>";
			//echo "<P>$sql</P>";
			echo "<script>alert('Aktiviti tidak berjaya didaftarkan');</script>";
	   }
	   //echo $sql;
	}
	if (($_REQUEST["aid"] >= 1) || ($_POST["aid"] >= 1) || ($add == 1))
	{
		if ($add == 1)
			$sql = "SELECT * FROM activities ORDER BY ActivityID DESC LIMIT 0, 1 ";
		else
			$sql = "SELECT * FROM activities WHERE ActivityID=".$_REQUEST["aid"];
		$row = mysql_fetch_array(mysql_query($sql));
		$start = date("z", strtotime($row["DateOfEvent"]));
		$end = date("z", strtotime($row["DateOfEnd"]));
		$yearmode1 = date("Y", strtotime($row["DateOfEnd"]));
		$yearmode2 = date("z", strtotime($yearmode1."-12-31 23:59:59"));
		if ($start > $end)
			$end = 2+$end + $yearmode2;
		$totalDays = 1+(int)$end-(int)$start;
		
		$month = date("F", strtotime($row["DateOfEvent"]));
		$month2 = date("m", strtotime($row["DateOfEvent"]));
		$year = date("Y", strtotime($row["DateOfEvent"]));
		$condMonth = $year.$month2;
		$dateStartEvent = $condMonth;
		//die($sql.$row["Name"]);
	}
	if ($showform == 1)
		include "modules/activityform2.php";
	else
		include "modules/activityform.php";
	
?>


