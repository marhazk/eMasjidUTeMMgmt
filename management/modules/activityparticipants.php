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
?>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>

<body>
<form method=post>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4"><strong>SENARAI PESERTA MENGIKUT AKTIVITI</strong></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
  </tr>
  <tr>
    <td >Bulan</td>
    
    <?php
	if ($_POST["chk"] == "Batal")
	{
		unset($_POST["aBulan"]);
	?>
    
    <td colspan="3"><select name="aBulan" id="aBulan">
    
    <?php
	} else if (isset($_POST["aBulan"]))
	  {
	?>
    <td colspan="3"><select name="aBulan" id="aBulan" disabled>
    <?php
	} else if ($_POST["chk"] != "Batal")
	  {
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
    <td >Aktiviti</td>
    <td colspan="3"><select name="aID" size="1" id="aID"><option value="" selected>-</option>
      <?php
	  if ($_POST["chk"] != "Batal")
	  {
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
	}
	}?>
      
    </select></td>
	</tr>
    <?php } ?>
  <tr>
    <td >&nbsp;</td>
    <td ><input type="submit" name="chk" id="chk" value="Papar" />
    <input type="submit" name="chk" id="button32" value="Batal" /></td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
  </tr>  <?php if (isset($rowx))
  {
  ?>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
  </tr></table><table width=100%>
  <tr>
    <td >Nama Aktiviti </td>
    <td >
    <?php
		$totalDays = 0;
		$start = date("z", strtotime($xrow["DateOfEvent"]));
		$end = date("z", strtotime($xrow["DateOfEnd"]));
		$yearmode1 = date("Y", strtotime($xrow["DateOfEnd"]));
		$yearmode2 = date("z", strtotime($yearmode1."-12-31 23:59:59"));
		if ($start > $end)
			$end = 2+$end + $yearmode2;
		$totalDays = 1+(int)$end-(int)$start;
	?>
    <input type="hidden" value="<?php echo $rowx["ActivityID"];?>" name="aID2"/>
    <input type="hidden" value="<?php echo $totalDays;?>" name="sTotal"/>
    <input type="text" value="<?php echo $rowx["Name"];?>" name="txtSesi22" size="30" readonly="readonly" /></td>
	<td >Masa</td>
	<td ><input type="text" value="<?php echo $time;?>" name="txtSesi24" size="30" readonly="readonly" /></td>
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
    <td><input type="text" value="<?php echo $totalDays;?>" name="txtSesi25" size="30" readonly="readonly" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table><table width=100%>
  <?php if (isset($rowx))
  {
  ?>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><strong>SENARAI PESERTA (STAFF)</strong></td>
  </tr>
  <tr>
    <td ><strong>BIL</strong></td>
    <td ><strong>NO.STAF</strong></td>
	<td ><strong>NAMA</strong></td>
	<td ><strong>PEJABAT</strong></td>
  </tr>
  <?php
  $num = 1;
    $sql = mysql_query("SELECT * FROM participants, staff, office, officecode where participants.aid=$aid AND staff.StaffID=participants.uid AND office.StaffID=staff.StaffID AND officecode.OfficeID=office.OfficeID GROUP BY participants.uid, staff.StaffID, office.StaffID ORDER BY officecode.OfficeID DESC");
	while ($row = mysql_fetch_array($sql))
	{
  ?>
  <tr>
    <td ><span class="style1"><?php echo $num;?></span></td>
    <td ><?php echo $row["StaffID"];?>
    </td>
	<td ><?php echo $row["Name"];?></td>
	<td ><?php echo $row["OfficeName"];?></td>
  </tr>
  <?php $num++; } ?>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><strong>SENARAI PESERTA (PELAJAR)</strong></td>
  </tr>
  <tr>
    <td><strong>BIL</strong></td>
    <td><strong>NO.MATRIK</strong></td>
    <td><strong>NAMA</strong></td>
    <td><strong>TAHUN &amp; FAKULTI</strong></td>
  </tr>
  <?php
  $num = 1;
    $sql = mysql_query("SELECT * FROM participants, studentdetails where participants.aid=$aid AND studentdetails.UserID=participants.uid GROUP BY studentdetails.UserID");
	while ($row = mysql_fetch_array($sql))
	{
  ?>
  <tr>
    <td ><span class="style1"><?php echo $num;?></span></td>
    <td ><?php echo $row["UserID"];?>
    </td>
	<td ><?php echo $row["Name"];?></td>
	<td ><?php echo $row["Year"];?><?php echo $row["Course"];?> <?php echo $row["Faculty"];?></td>
  </tr>
  <?php $num++; } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>
  </tr>  
</table>
<table width=100%>
<tr>
<td width=100%>
    <input type="button" onClick="window.history.go(-1);" name="button" id="button" value="Kembali" />
    </td>
</tr><?php } } ?>
    </table>
    
</form>
<p>&nbsp;</p>
</center>
</body>
</html>