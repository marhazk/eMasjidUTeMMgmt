<?php
	// 0 = Not Logged in
	// 1 = Unexisted user - unknown user
	// 2 = Unexisted user - fail auth
	// 3 = Invalid auth
	// 5 = Logged in
	$cookieidDetail = 0;
	$cookieExpiry = 60*15; //expired in 15 minutes

	// EOF
	
	$uAuth = $_REQUEST[auth];
	$uID = $_REQUEST[uid];
	if ((strlen($uAuth) >= 10) || (strlen($uID) >= 5))
	{
		if (strlen($uAuth) >= 10)
		{
			$usql = mysql_query("SELECT * FROM auth, staff, office, officecode, position, positioncode where auth.code='$uAuth' AND auth.StaffID=staff.StaffID AND office.StaffID=staff.StaffID AND position.StaffID=staff.StaffID AND position.PosID=positioncode.PosID AND office.OfficeID=officecode.OfficeID GROUP BY staff.StaffID, position.StaffID, office.StaffID, position.PosID, office.OfficeID, positioncode.PosName, officecode.OfficeName");
		}
		else if (strlen($uID) == 5)
		{
			$usql = mysql_query("SELECT * FROM staff, office, officecode, position, positioncode where staff.StaffID='$uID' AND office.StaffID=staff.StaffID AND position.StaffID=staff.StaffID AND position.PosID=positioncode.PosID AND office.OfficeID=officecode.OfficeID GROUP BY staff.StaffID, position.StaffID, office.StaffID, position.PosID, office.OfficeID, positioncode.PosName, officecode.OfficeName");
		}
		else if (strlen($uID) == 10)
		{
			$usql = mysql_query("SELECT * FROM student, faculty, facultycode, tahun, kursuscode where student.sID='$uID' AND student.sID=faculty.sID AND faculty.fID=facultycode.fID AND tahun.sID=student.sID AND kursuscode.kID=tahun.kID GROUP BY student.sID, faculty.sID, tahun.sID");
		}
		$urow = mysql_fetch_array($usql);
		setcookie("$cookienameName",strName($urow["Name"]), time()+$cookieExpiry);
	}
	if ($cookieAuthID >= 1)
	{
		setcookie("$cookienameID",$cookieAuthID, time()+$cookieExpiry);
		$userRow = mysql_fetch_array(MySQL_Query("SELECT * FROM admin WHERE aid='$cookieAuthID' LIMIT 0,1"));
		$account = $userRow;
		if ($_REQUEST["op"] == "logout")
		{
			$logoutmsg = "<p>Anda telah berjaya keluar dari sistem.</p>";
			setcookie($cookienameID, "", time()-3600);
			$account[ufull] = "";
		}
	}
	else if (isset($_POST['username']))
	{
		setcookie($cookienameID, "", time()-3600);
		//$_SESSION[$cookienameID] = 0;
		//$_SESSION[$cookienameAuth] = 0;
		$Login = $_POST['username'];
		$pwd = $_POST['passwd'];
		
		
		if (empty($Login) || empty($pwd))
		{
			$uWeb_accountdbmsg = " - All fields is empty.";
		}
		else if ($userRow = mysql_fetch_array(MySQL_Query("SELECT * FROM admin WHERE uname='$Login' AND upass='$pwd' LIMIT 0,1")))
		{
			if ((StrLen($Login) < 4) or (StrLen($Login) > 10)) 
			{
				$uWeb_accountdbmsg = " - Login must have more 4 and not more 10 symbols.";
			}
			else if ((StrLen($pwd) < 4) or (StrLen($pwd) > 10)) 
			{
				$uWeb_accountdbmsg = " - Password must have more 4 and not more 10 symbols.";
			}
			else if ((StrLen($pwd) < 4) or (StrLen($pwd) > 10))
			{
				$uWeb_accountdbmsg = " - Repeat password must have more 4 and not more 10 symbols.";
			}
			else if ($userRow["aid"] >= 1)
			{
				$userWebID=5;
				$chkid = $userRow["aid"];
				$uWeb_vinfo = $userRow;
				$cookieAuthID = $chkid;
				setcookie("$cookienameID",$userRow['aid'], time()+$cookieExpiry);
				$account = $userRow;
			}
			else
			{
				die("TEST".$userRow["aid"]);
			}
		}
	}
	if ($cookieAuthID >= 1)
	{
		$admin = 1;
	}

?>