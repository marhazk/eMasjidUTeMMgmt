<?php
	define ("FILEREPOSITORY","./poster/");
if ($_POST["chk"] == "Save")
{
	echo "<P>The details have been saved.</P>";
}
elseif ($_POST["chk"] == "Daftar")
{

   if (is_uploaded_file($_FILES['ebanner']['tmp_name'])) {

         $name = $_FILES['ebanner']['name'];
         $result = move_uploaded_file($_FILES['ebanner']['tmp_name'], FILEREPOSITORY."/$name.jpg");
         if ($result == 1) echo "<p>Banner berjaya disimpankan.</p></p>";
         else echo "<p>Banner tidak berjaya disimpankan.</p>";

   }
   $ptjstatement = "";
   $num = 0;
   $query = mysql_query("SELECT * FROM OfficeCode");
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
   $sql = "INSERT INTO activities (name, DateofPublish, DateofEvent, DateofEnd, Description, ImageURL, Location, studentreg, staffreg, nonreg, signedstaff, ptj, org, contactnum) VALUES ('".$_POST["ename"]."',".DATE("'".$_POST["ey1"]."-".$_POST["em1"]."-".$_POST["ed1"]." ".$_POST["ehh1"].":".$_POST["emm1"].":00'").",".DATE("'".$_POST["ey2"]."-".$_POST["em2"]."-".$_POST["ed2"]." ".$_POST["ehh2"].":".$_POST["emm2"].":00'").",".DATE("'".$_POST["ey3"]."-".$_POST["em3"]."-".$_POST["ed3"]." ".$_POST["ehh3"].":".$_POST["emm3"].":00'").",'".$_POST["edesc"]."','".$name."','".$_POST["KodFakulti"]."','".$_POST["epartyes2"]."','".$_POST["epartyes"]."','".$_POST["epartno"]."','".$_POST["epartno2"]."','".$ptjstatement."','".$_POST["eorg"]."','".$_POST["econtact"]."');";
   $qSQL = mysql_query($sql);
   if ($qSQL)
   {
		echo "<P>Aktiviti telah didaftarkan</P>";
		$add = 1;
   }
   else
   {
		echo "<P>Aktiviti tidak berjaya didaftarkan</P>";
   }
   //echo $sql;
}
	if (($_REQUEST["aid"] >= 1) || ($add == 1))
	{
		if ($add == 1)
			$sql = "SELECT * FROM activities ORDER BY ActivityID DESC LIMIT 0, 1 ";
		else
			$sql = "SELECT * FROM activities WHERE activityid=".$_REQUEST["aid"];
		$row = mysql_fetch_array(mysql_query($sql));
		//die($sql.$row["Name"]);
	}
?>

<form name="form1" method="post" action="?op=activityjoin">
  <table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40%"><strong>MAKLUMAT AKTIVITI</strong></td>
      <td width="2%">&nbsp;</td>
      <td width="58%">
          <?php 
	if ($admin >= 1)
	{
	?>
      <a href="?op=activityedit&aid=<?php echo $row["ActivityID"];?>">KEMAS KINI AKTIVITI <img src="btn/edit.png" width="23" height="24"></a><?php } ?></td>
    </tr>
    <tr>
      <td width="40%">Nama Aktiviti</td>
      <td width="2%">:</td>
      <td width="58%"><?php echo $row["Name"];?></td>
    </tr>
    <tr>
      <td width="40%">Lokasi</td>
      <td width="2%">:</td>
      <td width="58%"><?php echo $row["Location"];?></td>
    </tr>
    <tr>
      <td width="40%">Tarikh Mula</td>
      <td width="2%">:</td>
      <td width="58%"><?php echo $row["DateOfEvent"];?></td>
    </tr>
    <tr>
      <td width="40%">Tarikh Tamat</td>
      <td width="2%">:</td>
      <td width="58%"><?php echo $row["DateOfEnd"];?></td>
    </tr>
    <tr>
      <td>Nombor Telefon</td>
      <td>:</td>
      <td><?php echo $row["econtact"];?></td>
    </tr>
    <tr>
      <td>Penganjur</td>
      <td>:</td>
      <td><?php echo $row["org"];?></td>
    </tr>
    <tr>
      <td width="40%">Maklumat lanjut</td>
      <td width="2%">:</td>
      <td width="58%"><?php echo $row["Description"];?></td>
    </tr>
    <tr>
      <td height="500" colspan="3" valign="top"><img src="poster/<?php echo $row["ImageURL"];?>.jpg" width="500"></td>
    </tr>
    <tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td width="40%">Sekiranya anda berminat, sila isi maklumat dibawah:</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td width="40%"><strong>Untuk staf atau pelajar UTeM sahaja</strong></td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td width="40%">Staff atau Matrix ID</td>
      <td width="2%">:</td>
      <td width="58%"><p>
          <input name="userID" type="text" id="userID" size="50">
      </p>
      <p>        (eg: 01234)</p></td>
    </tr>
    <tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%"><input type="submit" name="chk" id="button" value="Daftar" /></td>
    </tr>
    <tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
  </table>
</form>
