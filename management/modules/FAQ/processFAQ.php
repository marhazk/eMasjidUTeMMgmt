
<?php
$Question = $_POST['Question'];
$Answer = $_POST['Answer'];
$theDate = isset($_REQUEST["Date1"]) ? $_REQUEST["Date1"] : "";
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

// sebelum ni faq ID pakai manual...so lpas develop auto generate, no need this orange block anymore :)
/* else if($FaqID =="")
{
	echo"<script> alert('Empty Field on Id');</script>";
	echo"<script> history.go(-1);</script>";
} */

else if($theDate =="")
{
	echo"<script> alert('Empty Field on Date');</script>";
	echo"<script> history.go(-1);</script>";
}
else
{
	$result = mysql_query("SELECT MAX(FaqID)AS MAXID FROM faq");
	while($row = mysql_fetch_array($result))
 	{
		$maxid2 = $row['MAXID'] + 1;
		
 	}
	
	$query = "INSERT INTO faq (FaqID, Question, Answer, Date, Author) VALUES ('".$maxid2."','".$Question."','".$Answer."','".$theDate."','".$Author."')";
	mysql_query($query)or die(error);
	
	echo "<script>alert('F.A.Q Has Sucessfully Added To Database')</script>";
}
	echo "Current ID :$maxid2<br />"; 
	echo "Question  : $Question <br />";
	echo "Answer    : $Answer <br />";
	echo "Author    : $Author <br />";
	echo "Date      : $theDate <br />";
?>
