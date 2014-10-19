
<center>
<?php

if ($_POST["chk"] == "Daftar")
{
	$total = $_POST["totalEvent"];
	$xsql = array();
	$fail = 0;
	$success = 0;
	$activitytemp = "";
	$activityfailtemp = "";
	for ($num = 0; $num < $total; $num++)
	{
		$join = $_POST["ajoin".$num];
		$limit = $_POST["alimit".$num];
		$days = ((int)$_POST["adays".$num])-1;
		$aid = $_POST["aid".$num];
		$oid = $_POST["oid".$num];
		$uid = $_POST["uid"];
		if (strlen($uid) == 10)
		{
			$regType = 2;	//STUDENT
			$sql = mysql_query("SELECT * FROM participants WHERE participants.aid=".$aid);
		}
		else if (strlen($uid) == 5)
		{
			$regType = 1;	//STAFF
			$sql = mysql_query("SELECT * FROM participants, staff, office WHERE participants.aid=".$aid." AND office.OfficeID=".$oid." AND staff.StaffID=participants.uid AND staff.StaffID=office.StaffID");
		}
		else
		{
			$regType = 0;	//UNKNOWN / Stranger / Alien
		}
		$aname = $_POST["aname".$num];
		$sqla = mysql_query("SELECT * FROM activities WHERE ActivityID=".$aid);
		$row = mysql_fetch_array($sqla);
		$xnum = 0;
		if ($join == 1)
		{
			while($xrow = mysql_fetch_array($sql))
			{
				if ($xrow["uid"] == $uid)
				{
					$xnum = 99999;
					break;
				}
				else if (($regType == 2) && (strlen($xrow["uid"]) == 10))
					$xnum++;
				else if (($regType == 1) && (strlen($xrow["uid"]) == 5))
					$xnum++;
				else if ($regType == 0)
				{
					$xnum = 99990;
					break;
				}
			}
			if ($xnum == 99999)
			{
				$activityfailtemp .= "$aname<BR><font color=red>AMARAN: Anda pernah mendaftar aktiviti tersebut sebelum ini. Sila pilih yang lain.</font><BR>";
				$fail = 1;
			}
			else if ($xnum == 99990)
			{
				$activityfailtemp .= "$aname<BR><font color=red>AMARAN: Pengesahan tidak sah.</font><BR>";
				$fail = 1;
			}
			else if (($row["studentreg"] < 1) && (strlen($uid) >= 10))
			{
				$activityfailtemp .= "$aname<BR><font color=red>AMARAN: Pelajar tidak dibenarkan memasuki aktiviti ini. Sila pilih yang lain.</font><BR>";
				$fail = 1;
			}
			else if ($xnum >= $limit)
			{
				$activityfailtemp .= "$aname<BR><font color=red>AMARAN: Aktiviti ini sudah penuh dan mencecah $limit peserta. Sila pilih yang lain.</font><BR>";
				$fail = 1;
			}
			else
			{
				$pstate = "";
				for ($numd = 0; $numd <= $days; $numd++)
				{
					if ($numd < $days)
					{
						$pstate .= "0:";
					}
					else
					{
						$pstate .= "0";
					}
				}
				$activitytemp[$num] = strtoupper($aname);
				$xsql[$num] = "INSERT INTO participants (uid, aid, state) VALUES ('$uid', $aid, '$pstate');";
				$success = 1;
			}
		}
	}
	
	//
	//
	// Bahagian query INSERT sekiranya pengguna tersebut tiada masalah bahagian pendaftaran
	if ($success == 1)
	{
		$activitytempsuccess = "";
		for ($num = 0; $num < $total; $num++)
		{
			$result = mysql_query($xsql[$num]);
			if ($result)
			{
				$success = 2;
				$activitytempsuccess .= $activitytemp[$num]."<BR>";
			}
			else
			{
				//$fail = 1;
				//$activityfailtemp .= $activitytemp[$num]."<BR><font color=red>AMARAN: Sila hubungi pihak pentadbir untuk masalah tersebut<font>";
			}
		}
	}
	?>
    <b>
    <?
	//
	//
	// Bahagian paparan
	if ($success == 2)
	{
?>
		<font color=green>Tahniah!
	  <p>Anda telah selesai mendaftar.</p>
	  <p><?php echo $activitytempsuccess;?></p></font>
<?php
	}
	if (($fail == 1) && ($success == 2))
	{
?>
<HR />
<?php
	}
	if ($fail == 1)
	{
?>

  <font color=red><p>Aktiviti yang anda tidak berjaya didaftarkan.</p></font>
  <p><?php echo $activityfailtemp;?></p>

<?php
	}	if (($fail == 0) && ($success == 0))
	{
?>

  <font color=red><p>Sila pilih salah satu atau lebih aktiviti untuk didaftarkan.</p></font>
  <script>alert('Sila pilih salah satu atau lebih aktiviti untuk didaftarkan.');window.history.go(-1);</script>
<?php
	}
}
?>
</b>
<input type=button onclick="window.history.go(-1);" value="Kembali" /></center>