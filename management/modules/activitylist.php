<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan=3><strong>Senarai Aktiviti</strong>
    </td>
  </tr>
  <?php
  $sql = mysql_query("SELECT * FROM activities order by DateOfEvent desc");
  $month = "";
  while ($row = mysql_fetch_array($sql))
  {
		$totalDays = 0;
		$start = date("z", strtotime($row["DateOfEvent"]));
		$end = date("z", strtotime($row["DateOfEnd"]));
		$yearmode1 = date("Y", strtotime($row["DateOfEnd"]));
		$yearmode2 = date("z", strtotime($yearmode1."-12-31 23:59:59"));
		if ($start > $end)
			$end = 2+$end + $yearmode2;
		$totalDays = 1+(int)$end-(int)$start;
	  if (date("F", strtotime($row["DateOfEvent"])) != $month)
	  {
		  $month = date("F", strtotime($row["DateOfEvent"]));
		  $year = date("Y", strtotime($row["DateOfEvent"]));
		  //$start = strtotime($row["DateOfEvent"]);
		  //$end = strtotime($row["DateOfEnd"]);
		  //$start = date("z", strtotime($row["DateOfEvent"]));
		  //$end = date("z", strtotime($row["DateOfEnd"]));
		  //$totalDays = 1+(int)$end-(int)$start;
		  
		  //$datetime1 = new DateTime(date("Y-m-d", strtotime($row["DateOfEvent"])));
		  //$datetime2 = new DateTime(date("Y-m-d", strtotime($row["DateOfEnd"])));
		  //$datetime1 = new DateTime($row["DateOfEvent"]);
		  //$datetime2 = new DateTime($row["DateOfEnd"]);
		  //$interval = $datetime1->diff($datetime2);
		  //$interval->format('%R%a days');
		  //$totalDays = round(abs($datetime2->format('U') - $datetime1->format('U')) / (60*60*24));

		  //$totalDays = (int)(((int)$end-(int)$start)/24/60/60)+1;
		  //if ($totalDays <= 0)
		  //	$totalDays = "N/a";
  ?>
  <tr>
    <td colspan=3>&nbsp;</td>  </tr>
  <tr>
    <td colspan=3><strong><?php echo $month;?> <?php echo $year;?></strong></td>
  </tr>
  <tr>
    <td><strong>Aktiviti</strong></td>
    <td><strong>Tarikh Mula Aktiviti</strong></td>
    <td><strong>Lokasi</strong></td>
  <?php 
	  }
  ?>
  <tr>
    <td width="50%"><a href="?op=activityinfo&aid=<?php echo $row["ActivityID"];?>"><?php echo $row["Name"];?></a></td>
    <td><?php echo $row["DateOfEvent"];?> (<?php echo $totalDays;?> hari)</td>
    <td><?php echo $row["Location"];?></td>
  </tr>
  <?php } ?>
</table>
