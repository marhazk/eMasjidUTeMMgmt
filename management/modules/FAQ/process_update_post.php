<?php 	
	$FaqID = $_POST['FaqID'];
	$Question = $_POST['Question'];
	$Answer = $_POST['Answer'];
	$Date = $_POST['Date'];
	$Author = $_POST['Author'];


if($Question =="")
{
	echo"<script> alert('Empty Field on Question');</script>";
	echo"<script> history.go(-1);</script>";
}
else if($Answer =="")
{
	echo"<script> alert('Empty Field on Answer');</script>";
	echo"<script> history.go(-1);</script>";
}
else if($Author =="")
{
	echo"<script> alert('Empty Field on Author');</script>";
	echo"<script> history.go(-1);</script>";
}

else if($Date =="")
{
	echo"<script> alert('Empty Field on Date');</script>";
	echo"<script> history.go(-1);</script>";
}
else if($FaqID =="")
{
	echo"<script> alert('Empty Field on Date');</script>";
	echo"<script> history.go(-1);</script>";
}

else
{
$query = "UPDate faq
          SET Question='$Question', 
              Answer='$Answer', 
			  Date='$Date', 
			  Author='$Author'
          WHERE 
	      FaqID='$FaqID'";
		  
mysql_query($query);

echo "<script>alert('UpDate F.A.Q Succeed')</script>";
echo "<script>window.location='?op=FAQ/manage_FAQ'</script>";
}
?>