<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style>
div.hide { display:none; }
div.show { }
</style>
<script>
function showhide(obj, obj2, obj3)
{
	if (document.getElementById(obj3).checked)
	    document.getElementById(obj).className = "show";
    else
		document.getElementById(obj).className = "hide";
	if (document.getElementById(obj3).checked)
	    document.getElementById(obj2).className = "show";
    else
		document.getElementById(obj2).className = "hide";
}
function showhide2(obj, obj2)
{
	if (document.getElementById(obj2).checked)
	{
	    document.getElementById(obj).className = "show";
	}
	else
	{
		document.getElementById(obj).className = "hide";
	}
	form1.ed1.value = "0";
}
function validateThis(v1, v2, v3)
{
	if (v1.value < form1.ey1.value) {
		if (v2.value < form1.em1.value) {
			if (v3.value < form1.ed1.value) {
				alert('ERROR: Tarikh dipilih tidak sah. Sila rujuk tarikh mula aktiviti');
				v3.value = form1.ed1.value;
				v2.value = form1.em1.value;
				v1.value = form1.ey1.value;
			}
		}
	}
}
</script>
<?php
	$edit = false;
	if ($_REQUEST["aid"] >= 1)
	{
		$edit = true;
		$aid = $_REQUEST["aid"];
		
		if ($add == 1)
			$sql = "SELECT * FROM activities ORDER BY ActivityID DESC LIMIT 0, 1 ";
		else
			$sql = "SELECT * FROM activities WHERE ActivityID=".$_REQUEST["aid"];
		$rowDB = mysql_fetch_array(mysql_query($sql));
		$start = date("z", strtotime($rowDB["DateOfEvent"]));
		$end = date("z", strtotime($rowDB["DateOfEnd"]));
		
		$eStart[0] = date("j", strtotime($rowDB["DateOfEvent"])); //j = day
		$eStart[1] = date("n", strtotime($rowDB["DateOfEvent"])); //n = month
		$eStart[2] = date("Y", strtotime($rowDB["DateOfEvent"])); //Y = year
		$eStart[3] = date("G", strtotime($rowDB["DateOfEvent"])); //G = hh
		$eStart[4] = date("i", strtotime($rowDB["DateOfEvent"])); //i = minute
		$eEnd[0] = date("j", strtotime($rowDB["DateOfEnd"])); //j = day
		$eEnd[1] = date("n", strtotime($rowDB["DateOfEnd"])); //n = month
		$eEnd[2] = date("Y", strtotime($rowDB["DateOfEnd"])); //Y = year
		$eEnd[3] = date("G", strtotime($rowDB["DateOfEnd"])); //G = hh
		$eEnd[4] = date("i", strtotime($rowDB["DateOfEnd"])); //i = minute
		$ePublish[0] = date("j", strtotime($rowDB["DateOfPublish"])); //j = day
		$ePublish[1] = date("n", strtotime($rowDB["DateOfPublish"])); //n = month
		$ePublish[2] = date("Y", strtotime($rowDB["DateOfPublish"])); //Y = year
		$ePublish[3] = date("G", strtotime($rowDB["DateOfPublish"])); //G = hh
		$ePublish[4] = date("i", strtotime($rowDB["DateOfPublish"])); //i = minute
		$totalDays = 1+(int)$end-(int)$start;
		
		
	}
?>
<form name="form1" method="post" enctype="multipart/form-data"  action="./?op=activityinfo">
  <table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40%"><strong>DAFTAR AKTIVITI </strong></td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
	<tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td width="40%">Nama Aktiviti (HURUF BESAR)</td>
      <td width="2%">:</td>
      <td width="58%"><span id="sprytextfield1"><span class="textfieldRequiredMsg"><BR />Sila isi nama aktiviti.</span><span class="textfieldMinCharsMsg">Mesti melebihi 10 aksara.</span><span class="textfieldMaxCharsMsg">Mesti kurang daripada 40 aksara.</span></span>
        <input name="ename" type="text" id="ename" value="<?php echo $rowDB["Name"]; ?>" size="50" maxlength="40" /></td>
    </tr>
    <tr>
      <td width="40%">Lokasi</td>
      <td width="2%">:</td>
      <td width="58%"><select name="KodFakulti" style="width:150" onchange="changeFakulti();">
		<?php
		$query = mysql_query("SELECT * FROM venue");
			while ($row = mysql_fetch_array($query))
			{
				if (($edit) && ($rowDB["Location"] == $row[Name]))
				{
        ?>
        <option selected value="<?php echo $row[Name];?>"><?php echo $row[Name];?></option>
        <?php } else { ?>
        <option value="<?php echo $row[Name];?>"><?php echo $row[Name];?></option>
        <?php } } ?>
        </select></td>
    </tr>
    <tr>
      <td width="40%">Tarikh Mula </td>
      <td width="2%">:</td>
      <td width="58%">Tarikh : 
        <select name="ed1" id="ed1" onclick="form1.ed2.value=form1.ed1.value;form1.ed3.value=form1.ed1.value;">
        <?php for ($num = 1; $num <= 31; $num++)
		{
			if (($edit) && ($num == $eStart[0]))
			{?>
        <option selected="selected" value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } else {?>
        <option value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php }
		} ?>
      </select>
/
<select name="em1" id="em1" onchange="form1.em2.value=form1.em1.value;form1.em3.value=form1.em1.value;">
        <?php for ($num = 1; $num <= 12; $num++) { if (($edit) && ($num == $eStart[1])) {?>
        <option selected value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php }  } ?>
</select>
/
<select name="ey1" id="ey1" onchange="form1.ey2.value=form1.ey1.value;form1.ey3.value=form1.ey1.value;">
<!--  <option>2010</option>
  <option>2011</option> -->
        <?php for ($num = 2012; $num <= 2014; $num++) { if (($edit) && ($num == $eStart[2])) {?>
        <option selected value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } } ?>
<!--  <option>2014</option>
  <option>2015</option>
  <option>2016</option>
  <option>2017</option> -->
</select>
Masa:
<select name="ehh1" id="ehh1" onchange="form1.ehh2.value=form1.ehh1.value;form1.ehh3.value=form1.ehh1.value;">
        <?php for ($num = 1; $num <= 23; $num++) { if (($edit) && ($num == $eStart[3])) {?>
        <option selected value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } } ?>
</select> 
: 
<select name="emm1" id="emm1" onchange="form1.emm2.value=form1.emm1.value;form1.emm3.value=form1.emm1.value;">
        <?php for ($num = 0; $num <= 59; $num++) { if (($edit) && ($num == $eStart[4])) {?>
        <option selected value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } } ?>
</select></td>
    </tr>
    <tr>
      <td width="40%">Tarikh Tamat </td>
      <td width="2%">:</td>
      <td width="58%">Tarikh : 
        <select name="ed2" id="ed2" onchange="validateThis(form1.ey2, form1.em2, form1.ed2);">
        <?php for ($num = 1; $num <= 31; $num++) { if (($edit) && ($num == $eEnd[0])) {?>
        <option selected value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } } ?>
      </select>
/
<select name="em2" id="em2" onchange="validateThis(form1.ey2, form1.em2, form1.ed2);">
        <?php for ($num = 1; $num <= 12; $num++) { if (($edit) && ($num == $eEnd[1])) {?>
        <option selected value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } } ?>
</select>
/
<select name="ey2" id="ey2" onchange="validateThis(form1.ey2, form1.em2, form1.ed2);">
        <?php for ($num = 2012; $num <= 2015; $num++) { if (($edit) && ($num == $eEnd[2])) {?>
        <option selected value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } } ?>
</select>
Masa: 
<select name="ehh2" id="ehh2">
        <?php for ($num = 0; $num <= 23; $num++) { if (($edit) && ($num == $eEnd[3])) {?>
        <option selected value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } } ?>
 </select>
: 
<select name="emm2" id="emm2">
        <?php for ($num = 0; $num <= 59; $num++) { if (($edit) && ($num == $eEnd[4])) {?>
        <option selected value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option value="<?php echo addZero($num); ?>"><?php echo addZero($num); ?></option>
        <?php } } ?>
 </select></td>
    </tr>
    <tr>
      <td>Tarikh Akhir Pendaftaran </td>
      <td>:</td>
      <td>Tarikh :
        <select name="ed3" id="ed3" onchange="validateThis(form1.ey3, form1.em3, form1.ed3);">
        <?php for ($num = 1; $num <= 31; $num++) { if (($edit) && ($num == $ePublish[0])) { ?>
        <option selected><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option><?php echo addZero($num); ?></option>
        <?php } } ?>
        </select>
        /
        <select name="em3" id="em3" onchange="validateThis(form1.ey3, form1.em3, form1.ed3);">
        <?php for ($num = 1; $num <= 12; $num++) { if (($edit) && ($num == $ePublish[1])) {?>
        <option selected><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option><?php echo addZero($num); ?></option>
        <?php } } ?>
        </select>
        /
        <select name="ey3" id="ey3" onchange="validateThis(form1.ey3, form1.em3, form1.ed3);">
        <?php for ($num = 2012; $num <= 2015; $num++) { if (($edit) && ($num == $ePublish[2])) {?>
        <option selected><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option><?php echo addZero($num); ?></option>
        <?php } } ?>
        </select>
        Masa:
        <select name="ehh3" id="ehh3">
        <?php for ($num = 0; $num <= 23; $num++) { if (($edit) && ($num == $ePublish[3])) {?>
        <option selected><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option><?php echo addZero($num); ?></option>
        <?php } } ?>
        </select>
        :
        <select name="emm3" id="emm3">
        <?php for ($num = 0; $num <= 59; $num++) { if (($edit) && ($num == $ePublish[4])) {?>
        <option selected><?php echo addZero($num); ?></option>
        <?php } else { ?>
        <option><?php echo addZero($num); ?></option>
        <?php } } ?>
      </select></td>
    </tr>
    <tr>
      <td>Nombor Telefon</td>
      <td>:</td>
      <td><span id="sprytextfield2">
      <input name="econtact" type="text" id="econtact" value="<?php echo $rowDB["ContactNum"];?>" size="50" />
      <span class="textfieldRequiredMsg"><BR />Sila isi nombor telefon.</span><span class="textfieldMaxCharsMsg"><BR />Nombor telefon melebihi had aksara.</span><span class="textfieldMinCharsMsg"><BR />Nombor telefon tidak sah..</span></span></td>
    </tr>
    <tr>
      <td width="40%">Penganjur</td>
      <td width="2%">:</td>
      <td width="58%"><input name="eorg" type="text" id="eorg" value="<?php echo $rowDB["org"]; ?>" size="50" /></td>
    </tr>
    <tr>
      <td>Banner</td>
      <td>:</td>
      <td><input type="file" name="ebanner" id="fileField" /></td>
    </tr>
    <tr>
      <td width="40%">Butiran Terperinci </td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td height="500" colspan="3" valign="top"><textarea name="edesc" id="edesc" cols="80" rows="30"><?php echo $rowDB["Description"]; ?></textarea></td>
    </tr>
    <tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td width="40%">Penyertaan Peserta</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
    <tr>
      <td>Pelajar UTeM </td>
      <?php 
	  if ($rowDB["studentreg"] >= 1)
	  	$maxStudReg = $rowDB["studentreg"];
	  else
	  	$maxStudReg = 10;
	  ?>
      <td><input name="studentregval" type="checkbox" id="studentregval" value="1" checked="checked" onclick="showhide2('textstudent', 'studentregval')"/></td>
      <td><div id="textstudent" class="show"><span id="sprytextfield4">
      <input name="enameStudent" type="text" id="enameStudent" value="<?php echo $maxStudReg;?>" size="5" />
      <span class="textfieldRequiredMsg">Hanya nombor sahaja dari 0-5000 peserta</span><span class="textfieldInvalidFormatMsg">.</span><span class="textfieldMaxValueMsg">Nilai yang dimasukkan adalah lebih besar daripada maksimum yang dibenarkan.</span></span></div></td>
    </tr>
   <!-- <tr>
      <td width="40%">Staf UTeM </td>
      <td width="2%">&nbsp;</td>
      <td width="58%"><select name="epartyes" id="epartyes">
        <option value=1 selected="selected" >Aktif</option>
        <option value=0>Tidak Aktif</option>
      </select></td>
    </tr> -->
    <tr>
      
      <td colspan=3><!--<p>* pilihan </p> -->
        <table width="100%%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="50%">Pusat Tanggungjawab </td>
            <td width="10%">Bilangan Peserta </td>
            <td width="5%">Aktif</td>
            <td width="15%">Bilangan Peserta Yang Dikehendaki </td>
            <td width="20%">Salin</td>
          </tr>
          <?php
		  	$num = 0;
		  	$arrNum = 0;
		  	$query = mysql_query("SELECT * FROM officecode");
			$rowDBptj = explode(":", $rowDB["ptj"]);
			foreach ($rowDBptj as $rowPTJ)
			{
				if ($num == 0)
					$stateDB[$arrNum][id] = $rowPTJ;
				if ($num == 1)
					$stateDB[$arrNum][enable] = $rowPTJ;
				if ($num == 2)
					$stateDB[$arrNum][total] = $rowPTJ;
				if ($num == 3)
				{
					$stateDB[$arrNum][StaffID] = $rowPTJ;
					$arrNum++;
				}
				$num++;
				if ($num >= 4)
					$num = 0;
			}
		  	$num = 0;
			while ($row = mysql_fetch_array($query))
			{
				$num++;
		  ?>
          <tr>
            <td width="50%"><?php echo $row["OfficeName"]; ?></td>
            <?php
			$totalstaff = 0;
		  	$query2 = mysql_query("SELECT * FROM office WHERE OfficeID=".$row["OfficeID"]);
			while ($row2 = mysql_fetch_array($query2))
			{
				$totalstaff++;
			}
			$tstaff[($num-1)] = $totalstaff;
			
				if ($row["OfficeID"] == 16)			//PJKA
					$maxDefVal = 1;
				else if ($row["OfficeID"] == 17)	//PPP
					$maxDefVal = 1;
				else if ($row["OfficeID"] == 18)	//PPS
					$maxDefVal = 3;
				else if ($row["OfficeID"] == 19)	//PENERBIT
					$maxDefVal = 3;
				else if ($row["OfficeID"] == 20)	//PPB
					$maxDefVal = 1;
				else
					$maxDefVal = 10;
				if (($edit) && ($stateDB[($num-1)][total] >= 0))
					$maxDefVal = $stateDB[($num-1)][total];
			?>
            <td width="10%"><?php echo $totalstaff;?></td>
            <td width="5%">
                  <input name="eaktif<?php echo $num;?>" type="checkbox" id="eaktif<?php echo $num;?>" value="1" checked="checked" onclick="showhide('text-<?php echo $num;?>','textx-<?php echo $num;?>','eaktif<?php echo $num;?>')"/></td>
                  
            <td width="15%"><div id="text-<?php echo $num;?>" class="show"><span id="sprytextfield3-<?php echo $num;?>">
            <input name="enamex<?php echo $num;?>" type="text" id="ename2" value="<?php echo $maxDefVal; ?>" size="5" />
            <span class="textfieldRequiredMsg"><BR />Sila isi sekurang-kurangnya nilai 0 minimum</span>
            <span class="textfieldMaxCharsMsg"><BR />Melebihi had jumlah peserta.</span>
            <span class="textfieldMinCharsMsg"><BR />Sila isi sekurang-kurangnya nilai 0 minimum</span>
            <span class="textfieldMaxValueMsg"><BR />Nilai yang dimasukkan adalah lebih besar daripada maksimum yang dibenarkan.</span>
            <span class="textfieldMinValueMsg"><BR />Nilai yang dimasukkan adalah kurang daripada minimum yang diperlukan.</span></div></td>
            <td width="20%"><div id="textx-<?php echo $num;?>" class="show"><select name="epartx<?php echo $num;?>" id="epartno3">
            <?php
		  	$query2 = mysql_query("SELECT staff.Name, staff.StaffID, position.StaffID, position.PosID, office.OfficeID FROM staff, office, position WHERE office.OfficeID=".$row["OfficeID"]." AND office.StaffID = staff.StaffID AND (position.PosID=4 OR position.PosID=20) AND (position.status=1 OR office.status=1) AND staff.StaffID = position.StaffID GROUP BY staff.Name, position.StaffID, office.StaffID");
			while ($row2 = mysql_fetch_array($query2))
			{
						$query3 = mysql_query("SELECT * FROM staff WHERE StaffID=".$row2["StaffID"]." LIMIT 0,1");
						$rowName = mysql_fetch_array($query3);
						if (($edit) && ($stateDB[($num-1)][total] == $rowName["StaffID"]))
						{
						?>
                        <option selected value="<?php echo $rowName["StaffID"]; ?>"><?php echo $rowName["Name"]; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $rowName["StaffID"]; ?>"><?php echo $rowName["Name"]; ?></option>
                      <?php 
						}
				//}
			} ?>
              
            </select></div></td>
          </tr>
          <?php } ?>
        </table>
      <p>&nbsp;</p></td>
    </tr>
    <tr>
      <td>Hantar notis pemberitahuan melalui email kepada semua staff mengikut PTJ masing-masin</td>
      <td><input name="sendEmail" type="checkbox" id="epartyes" value="1" checked="checked" onclick="showhide2('textstudent')"/></td>
      <td>&nbsp;</td>
    </tr>
<!--    <tr>
      <td width="40%">Peserta Luar </td>
      <td width="2%">&nbsp;</td>
      <td width="58%"><select name="epartno" id="epartno">
        <option value=1 >Aktif</option>
        <option value=0 selected="selected">Tidak Aktif</option>
      </select></td>
    </tr> -->
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">
      <input type=hidden name=epartno2 value="0" />
      <input type=hidden name=epartyes2 value=0 />
      <input type=hidden name=epartyes value=0 />
      <input type=hidden name=epartno value=0 />
      <?php
	  	if ($edit) {
		$btnName = "Simpan";
		?>
		
      <input type=hidden name=aid value=<?php echo $aid;?> />
		<?php
		}
		else $btnName = "Daftar";
	  ?>
      <input type="submit" name="chk" id="chk" value="<?php echo $btnName; ?>" />
      <input type="submit" name="xxx" id="xxx" value="Hapus" /></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:5, maxChars:40});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {hint:"Hanya nombor sahaja", maxChars:12, minChars:9});
<?php
for ($num = 1; $num <= 20; $num++)
{
	?>
	var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3-<?php echo $num;?>", "integer", {hint:"Hanya nombor sahaja", maxChars:3, minChars:1, maxValue:<?php echo $tstaff[($num-1)]; ?>});
<?php } ?>
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {maxValue:5000});
</script>
