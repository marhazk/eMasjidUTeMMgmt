<?php
if ((strlen($cookieAuthName) >= 1) && ($op == "activityjoined"))
{
?>
<?php } else if ((strlen($cookieAuthName) >= 1) && ($op == "activityjoin"))
{
?>
Selamat datang, <?php echo $cookieAuthName;?>
<?php } else if (strlen($account[ufull]) >= 1)
{
?>
Selamat datang, <?php echo $account[ufull];?>
<?php } else {?>
Selamat datang, pelawat
<?php } ?>