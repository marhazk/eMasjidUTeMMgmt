<?php 	
	$FaqID = $_GET["FaqID"];
    $order = "SELECT * FROM faq where FaqID='$FaqID'";
    $result = mysql_query($order);
    $row = mysql_fetch_array($result);
?>	
    <script type="text/javascript"></script>
    <style type="text/css">
    <!--
    .style2 {font-family: "terminator Cyr 4";
        font-size: 12px;
        color: #FF6600;
    }
    -->
    </style>
    <form id="viewpost" name="upDatepost" method="post" action="?op=FAQ/process_upDate_post">
	<table width="629" border="0" align="center">
    <tr>
    <td width="623"><textarea class="ckeditor" name="Question" cols="80" rows="5" id="Question" align="center"><?php echo $row['Question']; ?></textarea></td>
    </tr>
               <tr>
                <td width="623">
       <textarea class="ckeditor" name="Answer" cols="80" rows="10" id="Answer" align="center"><?php echo $row['Answer']; ?></textarea>
               </div></td>
              </tr>
              <tr>
                 <td><table width="339" height="60" border="0">
                   <tr>
                     <td>Date</td>
                     <td>:
                       <label>
                         <input type="" id="Date" name="Date" value="<?php echo $row['Date']; ?>" />
                       </label></td>
                   </tr>
                   <tr>
                     <td width="60" height="31">Author </td>
                     <td width="269">:
                       <label>
                         <input type="" id="Author" name="Author" value="<?php echo $row['Author']; ?>" />
                       </label>
                       <input type="hidden" id="FaqID" name="FaqID" value="<?php echo $row['FaqID']; ?>" readonly="readonly"  /></td>
                   </tr>
                 </table></td>
      </tr>
              <tr>
                 <td><div align="left"> <a href="?op=FAQ/manage_FAQ">
                   <input type="button" name="cancel" value="&lt; Cancel UpDate" align="left" />
                   </a>
                   <input type="submit" name="button_UpDatePost" id="button_UpDatePost" value="UpDate faq &gt;" align="left" />
                 </div></td>
      </tr>
              <tr>
              <td><label></label>
                  <label></label></td>
        	  </tr>
      </table>
      <p></p>
    </form>


