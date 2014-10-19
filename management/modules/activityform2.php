<form name="form1" method="post" action="?op=activityjoin">
  <table width="100%%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="40%"><strong>MAKLUMAT AKTIVITI</strong></td>
      <td width="2%">&nbsp;</td>
      <td width="58%"></td>
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
      <td><?php echo $row["ContactNum"];?></td>
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
    <?php if (strlen($row["ImageURL"]) >= 1) {?>
    <tr>
      <td height="500" colspan="3" valign="top"><img src="poster/<?php echo $row["ImageURL"];?>.jpg" width="500"></td>
    </tr>
    <?php }?>
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
      <td width="40%" valign="top">staff atau Matrix ID</td>
      <td width="2%" valign="top">:</td>
      <td width="58%" valign="top"><p>
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
      <td width="58%">
          <p>
          <input name="aBulan" type="hidden" value="<?php echo $dateStartEvent; ?>" size="50">
          <input name="aid" type="hidden" value="<?php echo $row["ActivityID"]; ?>" size="50">
          <input type="submit" name="chk" id="button" value="Daftar" /> 
          <?php if ($admin == 1) { ?> 
          <a href="?op=activityform&aid=<?php echo $row["ActivityID"]; ?>">
          <input type="button" name="chk" id="button" value="Kemas Kini" />
          </a> 
          <a href="?op=activityinfo&chk=Padam&aid=<?php echo $row["ActivityID"]; ?>">
          <input type="button" name="chk" id="button" value="Padam" />
          </a> <?php } ?><br />
          
          <?php 
	if ($admin >= 1)
	{
	?>
        </p>
          <p>MUAT TURUN SENARAI PESERTA untuk Kehadiran untuk:<BR />
            <?php
			for($num = 0; $num < $totalDays; $num++)
			{
		?>
            <a href="?op=activityPrintAtt&amp;aid=<?php echo $row["ActivityID"];?>&amp;header=1&day=<?php echo ($num+1)?>">Hari <?php echo ($num+1)?></a>
            <?php } ?>
            <a href="?op=activityPrintAtt&amp;aid=<?php echo $row["ActivityID"];?>&amp;header=1"></a><BR />
            <a href="?op=surat/surat1&header=1&aid=<?php echo $row["ActivityID"];?>&amp;header=1">MUAT TURUN SENARAI NAMA Surat Pertama</a>
            <BR />
            <a href="?op=surat/surat2&header=1&aid=<?php echo $row["ActivityID"];?>">MUAT TURUN SENARAI NAMA Surat Kedua</a><br />
            <a href="?op=surat/cpd&amp;header=1&amp;aid=<?php echo $row["ActivityID"];?>&amp;header=1">MUAT TURUN SENARAI PESERTA untuk CPD</a> </p>
	  <?php } ?></td>
    </tr>
    <tr>
      <td width="40%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="58%">&nbsp;</td>
    </tr>
  </table>
</form>