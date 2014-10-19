<?php
//$datetime = strtotime($row->createdate);
//$mysqldate = date("m/d/y g:i A", $datetime);

	$userID = $_REQUEST[uid];
	$userAuth = $_REQUEST[auth];
	$sql = mysql_query("SELECT * FROM staff, office, officecode, position, positioncode where staff.StaffID='$userID' AND office.StaffID=staff.StaffID AND position.StaffID=staff.StaffID AND position.PosID=positioncode.PosID AND office.OfficeID=officecode.OfficeID GROUP BY staff.StaffID, position.StaffID, office.StaffID, position.PosID, office.OfficeID, positioncode.PosName, officecode.OfficeName");
	$row = mysql_fetch_array($sql);
	if (true)
	//if (($row["authcode"] == $userAuth) && ($row["authValid"] == 1))
	{
	
?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<form name="form1" method="post" action="?op=activityjoined">
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
      <td>No.Matrik</td>
   <td> <?php
    if ($admin == 1)
	  	$readonly = "";
	else
	  	$readonly = " readonly=readonly";
	?>
      <input name="uid" type="text" value="<?php echo $userID;?>" id="ename" <?php echo $readonly;?> size="10" />
      <?php
    if ($admin == 1)
	  {?>
      <input type="submit" name="chk2" id="chk2" value="Carian"/>
<?php }	?>
    </td>
      <td>Tahun/Kursus</td>
	  <td width="51%"><input name="ename3" value="<?php echo $row["OfficeName"];?>" type="text" id="ename3" <?php echo $readonly;?>  size="50" /></td>
    </tr>
    <tr>
      <td>Nama</td>
      <td><input name="ename2" type="text" value="<?php echo $row["Name"];?>" id="ename2" size="50" <?php echo $readonly;?>  /></td>
      <td>Fakulti</td>
	  <td><input name="ename4" type="text" value="<?php echo $row["PosName"];?>" id="ename4" size="50" <?php echo $readonly;?>  /></td>
    </tr>
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
  while ($xrow = mysql_fetch_array($xsql))
  {
	  $totalOfoTokenID = ((int)($row["OfficeID"]) * 4) + 0;
	  $totalOfoTokenActive = $totalOfoTokenID + 1;
	  $totalOfoTokenTotal = $totalOfoTokenID + 2;
	  $tokenNum = 0;
	  $tokens = ":";
	  $tokenized = strtok($xrow["ptj"], $tokens);
	  $enable = 0;
	  $limit = 0;
	  $ptjID = 0;
		  //echo "Element ID = $totalOfoTokenID<br>";
		  //echo "Element Active = $totalOfoTokenActive<br>";
		  //echo "Element Total = $totalOfoTokenTotal<br>";
	  while ($tokenized) {
		  if ($tokenNum == $totalOfoTokenID)
		  {
			  $ptjID = $tokenized;
		  }
		  if ($tokenNum == $totalOfoTokenActive)
		  {
			  $enable = $tokenized;
		  }
		  if ($tokenNum == $totalOfoTokenTotal)
		  {
			  $limit = $tokenized;
		  }
		  //echo "Element NO $tokenNum = $tokenized<br>";
		  $tokenized = strtok($tokens);
		  $tokenNum++;
	  }
	  if (date("F", strtotime($xrow["DateOfEvent"])) != $month)
	  {
		  $month = date("F", strtotime($xrow["DateOfEvent"]));
		  $year = date("Y", strtotime($xrow["DateOfEvent"]));
  ?>
  	<tr>
      <td colspan="4"><strong>SENARAI AKTIVITI BULAN : <?php echo $month;?> <?php echo $year;?>
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
  <?php 
	  }
	  if ($enable == 1)
	  {
  ?>
	<tr>
	  <td><input type="checkbox" name="ajoin<?php echo $eid;?>" id="checkbox" />
	  <input type="hidden" name="alimit<?php echo $eid;?>" value="<?php echo $limit;?>"/>
	  <input type="hidden" name="aid<?php echo $eid;?>" value="<?php echo $xrow["ActivityID"];?>"/>
	  <input type="hidden" name="aname<?php echo $eid;?>" value="<?php echo $xrow["Name"];?>"/>
	  <?php echo $xrow["Name"];?></td>
	  <td><?php echo $xrow["Location"];?></td>
	  <td><?php echo $xrow["DateOfEvent"];?></td>
	  <td><?php echo $xrow["org"];?></td>
    </tr>
    <?php
    $eid++;
	} } ?>
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
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td><input type="submit" name="chk" id="chk" value="Daftar" />
      <input type="submit" name="xxx" id="xxx" value="Batal" /></td>
    </tr>
	<tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
  </table>
</form>
<?php
	}
	else
	{?>
	<p>ERROR: Pengesahan pengguna tidak sah. Sila cuba sekali lagi</p>
    <?php
	}
	?>