<?php 	

	$FaqID = $_GET["FaqID"];
    $order = "SELECT * FROM faq where FaqID='$FaqID'";
    $result = mysql_query($order);
    $row = mysql_fetch_array($result);
?>	
    <html>
    <head>
    <script type="text/javascript"></script>
    <style type="text/css">
    <!--
    .style2 {font-family: "terminator Cyr 4";
        font-size: 12px;
        color: #FF6600;
    }
    -->
    </style>
    
    <form id="viewpost" name="viewpost">
	<table width="629" border="0" align="center">
    <tr>
    <td width="623"><textarea class="ckeditor" name="content_text" cols="80" rows="5" id="content_text" align="center" readonly ><?php echo $row['Question']; ?></textarea></td>
    </tr>
               <tr>
                <td width="623">
       <textarea class="ckeditor" name="content_text" cols="80" rows="10" id="content_text" align="center" readonly ><?php echo $row['Answer']; ?></textarea>
               </div></td>
              </tr>
              <tr>
                <td><table width="339" height="60" border="0">
                  <tr>
                    <td>Date</td>
                    <td>:
                      <label readonly><?php echo $row['Date']; ?></label></td>
                  </tr>
                  <tr>
                    <td width="60" height="31">Author </td>
                    <td width="269">:
                      <label readonly><?php echo $row['Author']; ?></label></td>
                  </tr>
                </table></td>
      </tr>
              <tr>
                <td><label></label>
                  <div align="center"> <a href="?op=FAQ/manage_home">
                    <input type="button" name="back" value=" Back " align="center" onClick="self.close()"/>
                    </a> <br />
                  </div>
                  <label></label></td>
              </tr>
      </table>
      <p></p>
    </form>
