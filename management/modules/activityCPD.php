<?php
if (($_POST["chk"] == "Papar") || ($_POST["chk"] == "Simpan"))
{

		if ($_POST["aID"] >= 1)
		{
			$aid = $_POST["aID"];
			$sql = mysql_query("SELECT * FROM activities WHERE ActivityID='".$_POST["aID"]."' OR ActivityID='".$_POST["aID2"]."'");
			$rowx = mysql_fetch_array($sql);
			$date = date("l jS \of F Y", strtotime($rowx["DateOfEvent"]));
			$date2 = date("l jS \of F Y", strtotime($rowx["DateOfEnd"]));
			$time = date("h:i:s A", strtotime($rowx["DateOfEvent"]));
			$start = date("z", strtotime($rowx["DateOfEvent"]));
			$end = date("z", strtotime($rowx["DateOfEnd"]));
			$totalDays = 1+(int)$end-(int)$start;
		  	$month2 = date("m", strtotime($rowx["DateOfEvent"]));
			$year = date("Y", strtotime($rowx["DateOfEvent"]));
			$condMonth2 = $year."-".$month2;
			$_POST["aBulan"] = $condMonth2;
			$_REQUEST["aID"] = $aid;
		}

}
if ($_POST["chk"] == "Simpan")
{
	$ssql = mysql_query("SELECT * FROM participants WHERE aid='".$_POST["aID2"]."'");
	$days = $_POST["sTotal"];
	while ($srow = mysql_fetch_array($ssql))
	{
		$pstate = "";
		$uid = $srow["uid"];
		for ($num = 0; $num <= $days; $num++)
		{
			$dayChk1 = $_POST["aID".$uid."day".$num."a"];
			$dayChk2 = $_POST["aID".$uid."day".$num."b"];
			$dayChk3 = $_POST["aID".$uid."day".$num."c"];
			if (($dayChk1 == 1) && ($dayChk2 == 0) && ($dayChk3 == 0)) { $dayVal = 1; }
			elseif (($dayChk1 == 0) && ($dayChk2 == 1) && ($dayChk3 == 0)) { $dayVal = 2; }
			elseif (($dayChk1 == 1) && ($dayChk2 == 1) && ($dayChk3 == 0)) { $dayVal = 3; }
			elseif (($dayChk1 == 0) && ($dayChk2 == 0) && ($dayChk3 == 1)) { $dayVal = 4; }
			elseif (($dayChk1 == 1) && ($dayChk2 == 0) && ($dayChk3 == 1)) { $dayVal = 5; }
			elseif (($dayChk1 == 0) && ($dayChk2 == 1) && ($dayChk3 == 1)) { $dayVal = 6; }
			elseif (($dayChk1 == 1) && ($dayChk2 == 1) && ($dayChk3 == 1)) { $dayVal = 7; }
			else
			{
				$dayVal = 0;
			}
				
			if ($num < $days)
			{
				$pstate .= "$dayVal:";
			}
			else
			{
				$pstate .= "$dayVal";
			}
		}
		$supsql = mysql_query("UPDATE participants SET state='$pstate' WHERE uid=$uid AND aid='".$_POST["aID2"]."'");
		//echo "<P>Anda telah berjaya mengemaskini CPD staff ID $uid</p>";
	}
	echo "<P>Anda telah berjaya mengemaskini CPD aktiviti tersebut</p>";
}
?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>

<body>
<form method=post>
<table width="100%%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4"><strong>SENARAI PESERTA MENGIKUT AKTIVITI (CPD) </strong></td>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="23%">&nbsp;</td>
	<td width="17%">&nbsp;</td>
	<td width="51%">&nbsp;</td>
  </tr>
  <tr>
    <td width="9%">Bulan</td>
    
    <?php
	if (isset($_POST["aBulan"]))
	{
	?>
    
    <td colspan="3"><select name="aBulan" id="aBulan" disabled>
    
    <?php
	} else {
	?>
    <td colspan="3"><select name="aBulan" id="aBulan">
      <?php
	}
	$sql = mysql_query("SELECT * FROM activities order by DateOfEvent desc");
	$month = "";
	while ($row = mysql_fetch_array($sql))
	{
		if (date("F", strtotime($row["DateOfEvent"])) != $month)
		{
		  $month = date("F", strtotime($row["DateOfEvent"]));
		  $month2 = date("m", strtotime($row["DateOfEvent"]));
		  $year = date("Y", strtotime($row["DateOfEvent"]));
		  $condMonth = $year."-".$month2;
		  if (($_POST["aID"] == $row["ActivityID"]) || ($_POST["aID2"] == $row["ActivityID"]) || ($_POST["aBulan"] == $condMonth))
		  {
		  ?>
      <option selected value="<?php echo $year;?>-<?php echo $month2;?>" ><?php echo $year;?> <?php echo $month;?></option>
      <?php } else {?>
      <option value="<?php echo $year;?>-<?php echo $month2;?>" ><?php echo $year;?> <?php echo $month;?></option>
      <?php }
		}
	}
	?>
    </select></td>
    </tr>
    <?php
	
	if (isset($_POST["aBulan"]))
	{
	?>
  <tr>
    <td width="9%">Aktiviti</td>
    <td colspan="3"><select name="aID" size="1" id="aID"><option value="" selected>-</option>
      <?php
    $sql = mysql_query("SELECT * FROM activities order by DateOfEvent desc");
	$month = "";
	while ($row = mysql_fetch_array($sql))
	{

		  $month = date("F", strtotime($row["DateOfEvent"]));
		  $month2 = date("m", strtotime($row["DateOfEvent"]));
		  $year = date("Y", strtotime($row["DateOfEvent"]));
		  $condMonth = $year."-".$month2;
		  if ($_POST["aBulan"] == $condMonth)
		  {
			  if ($row["ActivityID"] == $_REQUEST["aID"])
			  {
			  ?>
      <option selected value="<?php echo $row["ActivityID"];?>" ><?php echo $row["Name"];?></option>
      <?php
			  } else {
				  ?>
      <option value="<?php echo $row["ActivityID"];?>" ><?php echo $row["Name"];?></option>
      
      <?php 	}
		  }

	}?>
      
    </select></td>
	</tr>
    <?php } ?></table><table width=100%>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="23%"><input type="submit" name="chk" id="chk" value="Papar" />
    <input type="submit" name="button32" id="button32" value="Batal" /></td>
	<td width="17%">&nbsp;</td>
	<td width="51%">&nbsp;</td>
  </tr>  <?php if (isset($rowx))
  {
  ?>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="23%">&nbsp;</td>
	<td width="17%">&nbsp;</td>
	<td width="51%">&nbsp;</td>
  </tr>
  <tr>
    <td width="9%">Nama Aktiviti </td>
    <td width="23%">
    <?php
		$start = date("z", strtotime($rowx["DateOfEvent"]));
		  $end = date("z", strtotime($rowx["DateOfEnd"]));
		  $totalDays = (int)$end-(int)$start;
	?>
    <input type="hidden" value="<?php echo $rowx["ActivityID"];?>" name="aID2"/>
    <input type="hidden" value="<?php echo $totalDays;?>" name="sTotal"/>
    <input type="text" value="<?php echo $rowx["Name"];?>" name="txtSesi22" size="30" readonly="readonly" /></td>
	<td width="17%">Masa</td>
	<td width="51%"><input type="text" value="<?php echo $time;?>" name="txtSesi24" size="30" readonly="readonly" /></td>
  </tr>
  <tr>
    <td>Tarikh Mula</td>
    <td><input type="text" value="<?php echo $date;?>" name="txtSesi23" size="30" readonly="readonly" /></td>
	<td>Tempat</td>
	<td><input type="text" value="<?php echo $rowx["Location"];?>" name="txtSesi25" size="30" readonly="readonly" /></td>
  </tr>
  <tr>
    <td>Tarikh Tamat</td>
    <td><input type="text" value="<?php echo $date2;?>" name="txtSesi23" size="30" readonly="readonly" /></td>
    <td>Jumlah Hari</td>
    <td><input type="text" value="<?php echo ($totalDays+1);?>" name="txtSesi25" size="30" readonly="readonly" /></td>
    </tr></table><table width=100%>
  <tr>
    <td width="9%">&nbsp;</td>
    <td width="23%">&nbsp;</td>
	<td width="17%">&nbsp;</td>
	<td width="51%">&nbsp;</td>
  </tr>
  </table><p><strong>SENARAI PESERTA </strong></p>
  <table width=100%>
  <tr>
    <td rowspan="2"><strong>BIL</strong></td>
    <td rowspan="2"><strong>NO.STAF</strong>
    <td align=center colspan=<?php echo $totalDays+1; ?>><strong>HARI</strong></td>
	<td rowspan="2"><strong>NAMA</strong></td>
	<td rowspan="2"><strong>PEJABAT</strong></td>
  </tr>
  <tr>
    <?php
	for ($num = 0; $num <= $totalDays; $num++)
	{
	?>
    <td align=center><strong><?php echo ($num+1);?></strong></td>
    <?php } ?>
	</tr>
  <?php

  $num = 1;
    $sql = mysql_query("SELECT * FROM participants, staff, office, officecode where participants.aid=$aid AND staff.StaffID=participants.uid AND office.StaffID=staff.StaffID AND officecode.OfficeID=office.OfficeID GROUP BY participants.uid, staff.StaffID, office.StaffID ORDER BY officecode.OfficeID DESC");
	while ($row = mysql_fetch_array($sql))
	{
  ?>
  <tr>
    <td><span class="style1"><?php echo $num;?></span></td>
    <td><?php echo $row["StaffID"];?>
    <?php
	$tokenNum = 0;
	$StaffID = $row["StaffID"];
	$toklist = $row["state"];
	$tokens = ":";
	$arr = explode(':', $row["state"]);
	//for ($tokenized = strtok($toklist, $tokens);$tokenized;$tokenized = strtok($tokens)) {
    $chk = "checked=checked";
    $nchk = "";
	foreach ($arr as $rx) {
        $a1 = "";
        $a2 = "";
        $a3 = "";
		if ($rx == 1) //1 0 0
		{
            $a1 = $chk; $a2 = $nchk; $a3 = $nchk;
		}
		elseif ($rx == 2) //0 1 0
		{
            $a1 = $nchk; $a2 = $chk; $a3 = $nchk;
		}
		elseif ($rx == 3) // 1 1 0
		{
            $a1 = $chk; $a2 = $chk; $a3 = $nchk;
		}
		elseif ($rx == 4) // 0 0 1
		{
            $a1 = $nchk; $a2 = $nchk; $a3 = $chk;
		}
		elseif ($rx == 5) // 1 0 1
		{
            $a1 = $chk; $a2 = $nchk; $a3 = $chk;
		}
		elseif ($rx == 6) // 0 1 1
		{
            $a1 = $nchk; $a2 = $chk; $a3 = $chk;
		}
		elseif ($rx == 7) // 1 1 1
		{
            $a1 = $chk; $a2 = $chk; $a3 = $chk;
		}
		else
		{
            $a1 = $nchk; $a2 = $nchk; $a3 = $nchk;
		}
        echo "<td align=center>S1 <input type=checkbox value=1 name=aID".$StaffID."day".$tokenNum."a ".$a1."><BR>S2 <input type=checkbox value=1 name=aID".$StaffID."day".$tokenNum."b ".$a2."><BR>S3 <input type=checkbox value=1 name=aID".$StaffID."day".$tokenNum."c ".$a3."></td>";
		$tokenNum++;
	}
	?>
    </td>
	<td><?php echo $row["Name"];?></td>
	<td><?php echo $row["OfficeName"];?></td>
  </tr>
  <?php $num++; } } ?>
</table>
<BR/>Nota: S1 - Sesi 1, S2 - Sesi 2, S3 - Sesi 3
<?php 
if ($num > 1)
{?>
  <p>
  	<input type="submit" name="chk" id="chk" value="Simpan" />
    <input type="button" onClick="window.open('?op=activityPrintCPD&amp;aid=<?php echo $aid;?>&amp;header=1','_blank');" name="button" id="button" value="Cetak" />
  </p>
  <?php } ?>
</form>
<p>&nbsp;</p>
</center>
</body>
</html>