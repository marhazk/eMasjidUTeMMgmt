<?php
//$datetime = strtotime($row->createdate);
//$mysqldate = date("m/d/y g:i A", $datetime);

	$userID = $_REQUEST[uid];
	$userAuth = $_REQUEST[auth];
	if ($_POST["chk"] == "Daftar")
	{
		$userID = $_POST["userID"];
	}
	if (strlen($userID) >= 10)
	{
		$text[0]	= "No.Matrik";
		$text[1]	= "Nama";
		$text[2]	= "Tahun/Kursus";
		$text[3]	= "Fakulti";
		$sql = mysql_query("SELECT * FROM studentdetails where UserID='$userID'");
		//$sql = mysql_query("SELECT * FROM student, faculty, facultycode, tahun, kursuscode where student.sID='$userID' AND student.sID=faculty.sID AND faculty.fID=facultycode.fID AND tahun.sID=student.sID AND kursuscode.kID=tahun.kID GROUP BY student.sID, faculty.sID, tahun.sID");
		$row = mysql_fetch_array($sql);
		$text[4]	= $userID;
		$text[5]	= $row["Name"];
		$text[6]	= $row["Year"].$row["Course"];
		$text[7]	= $row["Faculty"];
		//$text[5]	= $row["Name"];
		//$text[6]	= $row["tahun"].$row["kName"];
		//$text[7]	= $row["fname"];
		$student = true;
	}
	if ((strlen($userID) == 5) || (strlen($userAuth) >= 10))
	{
		$text[0]	= "No.Staf";
		$text[1]	= "Nama";
		$text[2]	= "Pejabat";
		$text[3]	= "Jawatan";
		if (strlen($userAuth) >= 10)
		{
			$sql = mysql_query("SELECT * FROM auth, staff, office, officecode, position, positioncode where auth.code='$userAuth' AND auth.StaffID=staff.StaffID AND office.StaffID=staff.StaffID AND position.StaffID=staff.StaffID AND position.PosID=positioncode.PosID AND office.OfficeID=officecode.OfficeID GROUP BY staff.StaffID, position.StaffID, office.StaffID, position.PosID, office.OfficeID, positioncode.PosName, officecode.OfficeName");
		}
		else
		{
			$sql = mysql_query("SELECT * FROM staff, office, officecode, position, positioncode where staff.StaffID='$userID' AND office.StaffID=staff.StaffID AND position.StaffID=staff.StaffID AND position.PosID=positioncode.PosID AND office.OfficeID=officecode.OfficeID GROUP BY staff.StaffID, position.StaffID, office.StaffID, position.PosID, office.OfficeID, positioncode.PosName, officecode.OfficeName");
		}
		$row = mysql_fetch_array($sql);
		$text[4]	= $row["StaffID"];
		$text[5]	= $row["Name"];
		$text[6]	= $row["OfficeName"];
		$text[7]	= $row["PosName"];
		$student = false;
		$userID = $row["StaffID"];
	}
		if ($row)
		//if (($row["authcode"] == $userAuth) && ($row["authValid"] == 1))
		{
			$account[ufull] = $row["Name"];
	
?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<form name="form1" method="post" action="?op=activityjoin">
  <table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="4"><strong>PENDAFTARAN AKTIVITI </strong></td>
    </tr>
    <tr>
      <td width="11%">&nbsp;</td>
      <td width="25%">&nbsp;</td>
      <td width="13%">&nbsp;</td>
    </tr>
    <tr>
      <td><?php echo $text[0];?></td>
   <td> <?php
    if ($admin == 1)
	  	$readonly = "";
	else
	  	$readonly = " readonly=readonly";
	?>
      <input name="uid" type="text" value="<?php echo $text[4];?>" id="ename" <?php echo $readonly;?> size="10" />
      <?php
    if ($admin == 1)
	  {?>
      <input type="submit" name="chk2" id="chk2" value="Carian"/>
<?php }	?>
    </td>
      <td><?php echo $text[2];?></td>
	  <td width="51%"><input name="ename3" value="<?php echo $text[6];?>" type="text" id="ename3" <?php echo $readonly;?>  size="50" /></td>
    </tr>
    <tr>
      <td><?php echo $text[1];?></td>
      <td><input name="ename2" type="text" value="<?php echo $text[5];?>" id="ename2" size="50" <?php echo $readonly;?>  /></td>
      <td><?php echo $text[3];?></td>
	  <td><input name="ename4" type="text" value="<?php echo $text[7];?>" id="ename4" size="50" <?php echo $readonly;?>  /></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>  	<tr>
      <td colspan="4"><strong>AKTIVITI BULANAN : 
        <select name="aBulan" id="aBulan">
          <?php
    $sql = mysql_query("SELECT * FROM activities order by DateOfEvent desc");
	$month = "";
	while ($rowxa = mysql_fetch_array($sql))
	{
		if (date("F", strtotime($rowxa["DateOfEvent"])) != $month)
		{
		  $month = date("F", strtotime($rowxa["DateOfEvent"]));
		  $month2 = date("m", strtotime($rowxa["DateOfEvent"]));
		  $year = date("Y", strtotime($rowxa["DateOfEvent"]));
		  $condMonth = $year.$month2;
		  if (($_POST["aID"] == $rowxa["ActivityID"]) || ($_POST["aID2"] == $rowxa["ActivityID"]) || ($_REQUEST["aBulan"] == $condMonth))
		  {
		  ?>
          <option selected="selected" value="<?php echo $year;?><?php echo $month2;?>" ><?php echo $year;?> <?php echo $month;?></option>
          <?php } else {?>
          <option value="<?php echo $year;?><?php echo $month2;?>" ><?php echo $year;?> <?php echo $month;?></option>
          <?php }
		}
	}
	?>
        </select>
        <input type="submit" name="chk" id="chk3" value="Papar" />
      </strong></td>
    </tr>
    </table>
    </form>
    <form name="form1" method="post" action="?op=activityjoined">
    <table width=100%>
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
  <?php
  $xsql = mysql_query("SELECT * FROM activities order by ActivityID desc");
  $month = "";
  $eid = 0;
	$duplicate = true;
	$display = 0;
	  
  while ($xrow = mysql_fetch_array($xsql))
  {
	  $totalOfoTokenID = ((int)($row["OfficeID"]) * 4) + 0;
	  $totalOfoTokenActive = $totalOfoTokenID + 1;
	  $totalOfoTokenTotal = $totalOfoTokenID + 2;
	  $tokenNum = 0;
	  $tokens = ":";
	  //$tokenized = strtok($xrow["ptj"], $tokens);
	  $enable = 0;
	  $limit = 0;
	  $ptjID = 0;
		  //echo "Element ID = $totalOfoTokenID<br>";
		  //echo "Element Active = $totalOfoTokenActive<br>";
		  //echo "Element Total = $totalOfoTokenTotal<br>";
		  $ptjDBtemp = explode(":",$xrow["ptj"]);
		  $ptjNum = 0;
		  $ptjArray = 0;
		  $ptjDB = array();
	foreach ($ptjDBtemp as $ptjVal)
	{
		$ptjNum++;
		if ($ptjNum == 1)
		{
			$ptjDB[$ptjArray][id] = $ptjVal;
			if ($row["OfficeID"] == $ptjDB[$ptjArray][id])
			{
				$ptjID = $ptjVal;
			}
		}
		else if ($ptjNum == 2)
		{
			$ptjDB[$ptjArray][enable] = $ptjVal;
			if ($row["OfficeID"] == $ptjDB[$ptjArray][id])
			{
				$enable = $ptjVal;
			}
		}
		else if ($ptjNum == 3)
		{
			$ptjDB[$ptjArray][limit] = $ptjVal;
			if ($row["OfficeID"] == $ptjDB[$ptjArray][id])
			{
				$limit = $ptjVal;
			}
		}
		else
		{
			$ptjNum = 0;
			$ptjDB[$ptjArray][staffID] = $ptjVal;
			$ptjArray++;
		}
	}
	  //while ($tokenized) {
		//  if ($tokenNum == $totalOfoTokenID)
		//  {
		//	  $ptjID = $tokenized;
		//  }
		//  if ($tokenNum == $totalOfoTokenActive)
		//  {
		//	  $enable = $tokenized;
	//	  }
	//	  if ($tokenNum == $totalOfoTokenTotal)
	//	  {
	//		  $limit = $tokenized;
	//	  }
		  //echo "Element NO $tokenNum = $tokenized<br>";
		  //$tokenized = strtok($tokens);
		  //$tokenNum++;
	  //}
	  if ($student)
	  	$limit = $xrow["studentreg"];
			  //echo "D".$condMonth.":".$_REQUEST["aBulan"].":".$xrow["Name"];
	  if (date("F", strtotime($xrow["DateOfEvent"])) != $month)
	  {
		  $month3 = date("F", strtotime($xrow["DateOfEvent"]));
		  $year = date("Y", strtotime($xrow["DateOfEvent"]));
		  $month2 = date("m", strtotime($xrow["DateOfEvent"]));
		  
		  //$sysStartTime = date("YmdHi", strtotime($xrow["DateOfPublish"]));
		  //$sysCurrentTime = date("YmdHi", time());
		  
		  $condMonth = $year.$month2;
		  if ($condMonth == $_REQUEST["aBulan"])
		  {
			  if (($duplicate) && ($limit > 0))
			  {
				  $duplicate = false;
  ?>
  	<tr>
      <td colspan="4"><strong>SENARAI AKTIVITI BULAN : <?php echo $month3;?> <?php echo $year;?>
      </strong></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Nama Aktiviti</strong></td>
      <td><strong>Lokasi</strong></td>
      <td><strong>Tarikh</strong></td>
	  <td><strong>Penganjur</strong></td>
    </tr>
    <?php } ?>
  <?php 
	  if ((($enable == 1) && ($student == false)) || (($limit > 0) && ($student)))
	  {

		$totalDays = 0;
		$start = date("z", strtotime($xrow["DateOfEvent"]));
		$end = date("z", strtotime($xrow["DateOfEnd"]));
		$yearmode1 = date("Y", strtotime($xrow["DateOfEnd"]));
		$yearmode2 = date("z", strtotime($yearmode1."-12-31 23:59:59"));
		if ($start > $end)
			$end = 2+$end + $yearmode2;
		$totalDays = 1+(int)$end-(int)$start;
		
		  $sysStartTime = strtotime($xrow["DateOfPublish"]);
		  $sysCurrentTime = time();
		  if (($sysStartTime-$sysCurrentTime) <= 0)
		  	$readOnlyVar = false;
		  else
		  	$readOnlyVar = true;
  ?>
	<tr>
	  <td>
      <?php if ($readOnlyVar) { ?>
      <input type="checkbox" name="ajoin<?php echo $eid;?>" value=1 id="checkbox" />
      <?php } else { ?>
      <input disabled="disabled" type="checkbox" name="ajoin<?php echo $eid;?>" value=1 id="checkbox" />
      <?php } ?>
	  <input type="hidden" name="adays<?php echo $eid;?>" value="<?php echo $totalDays;?>"/>
	  <input type="hidden" name="alimit<?php echo $eid;?>" value="<?php echo $limit;?>"/>
	  <input type="hidden" name="aid<?php echo $eid;?>" value="<?php echo $xrow["ActivityID"];?>"/>
	  <input type="hidden" name="oid<?php echo $eid;?>" value="<?php echo $ptjID;?>"/>
	  <input type="hidden" name="aname<?php echo $eid;?>" value="<?php echo $xrow["Name"];?>"/>
      <?php if ($readOnlyVar) { ?>
	  <?php echo $xrow["Name"];?></td>
      <?php } else { ?>
	  <font color=red><?php echo $xrow["Name"];?><BR />* Tarikh pendaftaran telah tutup</font></td>
      <?php } ?>
	  <td><?php echo $xrow["Location"];?></td>
	  <td><?php echo $xrow["DateOfEvent"];?> (<?php echo $totalDays;?> hari)</td>
	  <td><?php echo $xrow["org"];?></td>
    </tr>
    <?php
    $eid++;
	} } } } 
	if (($student) && ($eid < 1))
	{
	?>
    <tr><td colspan=4>Tiada aktiviti yang melibatkan pelajar di bulan ini.<td></tr>
	<?php }
	else if (($student == false) && ($eid < 1))
	{
	?>
    <tr><td colspan=4>Tiada aktiviti yang melibatkan PTJ anda di bulan ini.<td></tr>
	<?php } 
	?>
	<tr>
      <td>
	  <input type="hidden" name="totalEvent" value="<?php echo $eid;?>"/></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
		<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
    <?php if ($eid >= 1) { ?>
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td><input type="submit" name="chk" id="chk" value="Daftar" />
      </td>
    </tr>
    <?php } ?>
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
  </table>
      <input name="uid" type="hidden" value="<?php echo $userID;?>"/>
</form>
<?php
	}
	
	else
	{?>
	<p>ERROR: Pengesahan pengguna tidak sah. Sila cuba sekali lagi</p>

    <?php
			echo "<script>alert('ERROR: Pengesahan pengguna tidak sah. Sila cuba sekali lagi');</script>";
			echo "<script>window.history.go(-1);</script>";
	}
	?>