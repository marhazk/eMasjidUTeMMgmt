<?php 


		$FaqID=$_GET["FaqID"];
		$order = "DELETE FROM faq WHERE FaqID='$FaqID'";
		  
		mysql_query($order);
		
		echo "<script>alert('Post Deleted!')</script>";
		echo "<script>window.location='?op=FAQ/manage_FAQ'</script>";
?>
