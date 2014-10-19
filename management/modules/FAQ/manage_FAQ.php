
<script type="text/javascript">

function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=1,statusbar=0,menubar=0,resizable=1,width=1024,height=600,left =-10,top = 0');");
}
</script>


<body>

<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  
  
  
  <table width="100%" border="0" align="center">
    <tr bgcolor="#EAEAEA">
      <td width="60%"><div align="center"><b><font face="Calibri" color="#666666">F.A.Q Question</b></div></td>
      <td width="20%"><div align="center"><b><font face="Calibri" color="#666666">Author</b></div></td>
      <td width="20%"><div align="center"><b><font face="Calibri" color="#666666">Date</b></div></td>
    </tr>
    </table>
    <table width="100%" border="0" align="center">
    <?php 
	
	$get_data = "SELECT FaqID, Question, Answer, Date, Author FROM faq ORDER BY FaqID DESC ";
	$result = mysql_query($get_data);
	
 		while ($row=mysql_fetch_array($result))
			{
   			echo ("<tr><td width='60%' align='left'><font face='Calibri' color='#666666'>$row[Question]<BR><a href=\"javascript:popUp('?op=FAQ/view_post&FaqID=$row[FaqID]&header=1')\"><img src='images/view.png' width='30' border='0' title='View' ></a><a href=\"?op=FAQ/upDate_post&FaqID=$row[FaqID]\"><img src='images/update.png' width='30' border='0' title='Update'></a><a href=\"?op=FAQ/process_delete_post&FaqID=$row[FaqID]&action=delete\" onclick=\"javascript:return confirm('Are You Sure Want To Delete This Post?')\"><img src='images/delete.png' width='30' border='0' title='Delete'></a></td>");
    		echo ("<td width='20%' align='center'><font face='Calibri' color='#666666'>$row[Author]</td>");
    		echo ("<td width='20%' align='center'><font face='Calibri' color='#666666'>$row[Date]</td>");
			echo ("<tr><td colspan='3'><hr></td></tr>");
			}
	?>
   
     </table></td>
      </tr>
    </table>
  <div align="center"></div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>

