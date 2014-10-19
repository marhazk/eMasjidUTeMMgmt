<?php 
include "modules/config.php";
include "modules/accDB.php";
if (isset($_REQUEST["op"]))
{
	if ($_REQUEST["op"] == "logout")
	{
		$includefile = "activitylist";
		$admin = 0;
	}
	else
	{
		$includefile = $_REQUEST["op"];
	}
}
else
{
	$includefile = "activitylist";
}
if ((isset($_REQUEST["header"])) && ($_REQUEST["header"] == 1))
{
	include "modules/".$includefile.".php";
}
else
{
	include "template.php";
}
?>